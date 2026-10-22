<?php

namespace App\Services\OrganizacionTransferencia_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;
use App\Models\ArchivoUnidadActiva\ArchivoUnidadActivaModel;
use App\Models\CajaUnidadActiva\CajaUnidadActivaModel;
use App\Models\CarpetaUnidadActiva\CarpetaUnidadActivaModel;
use App\Models\DetalleTransferencia\DetalleTransferenciaModel;
use App\Models\DetalleUnidad\DetalleUnidadModel;
use App\Services\CajaUnidadActiva_services\registroCajaUnidadActivaServices;
use App\Services\CarpetaUnidadActiva_services\registroCarpetaUnidadActivaServices;

/**
 * Organización física (cajas/carpetas) del archivo transferido por una unidad suprimida.
 *
 * Reutiliza las tablas y servicios de unidades activas. La vigencia de cada caja se
 * identifica por (unidad, año): una unidad tiene un único detalle_unidad y cada detalle
 * un único archivo por año. Solo se trabajan vigencias con transferencias aprobadas.
 */
class organizacionTransferenciaService
{
    private const SOLICITUD_APROBADA = 4;

    public function __construct(
        private registroCajaUnidadActivaServices $registroCajas,
        private registroCarpetaUnidadActivaServices $registroCarpetas,
    ) {}

    public function vigenciasAprobadas($idUnidad)
    {
        try {
            $idArchivoUnidad = ArchivoUnidadActivaModel::where('id_unidad', $idUnidad)->value('id_archivo_unidad_activa');

            $vigencias = $this->archivosAprobados($idUnidad)->map(function ($archivo) use ($idArchivoUnidad) {
                $transferido = $this->detallesAprobados($archivo->id_archivo);
                $cajas = $this->cajasDeVigencia($idArchivoUnidad, $archivo->anio_registro_archivo);

                return [
                    'idArchivo'               => $archivo->id_archivo,
                    'anio'                    => (string) $archivo->anio_registro_archivo,
                    'cajasTransferidas'       => (int) $transferido->sum('cantidad_cajas_detalle_transferencia'),
                    'carpetasTransferidas'    => (int) $transferido->sum('cantidad_carpetas_detalle_transferencia'),
                    'foliosTransferidos'      => (int) $transferido->sum('cantidad_folios_detalle_transferencia'),
                    'cajasOrganizadas'        => $cajas->count(),
                    'carpetasOrganizadas'     => CarpetaUnidadActivaModel::whereIn('id_caja_unidad_activa', $cajas->pluck('id_caja_unidad_activa'))->count(),
                ];
            })->values();

            return Responses::success(200, 'Vigencias aprobadas', 'Se obtuvieron las vigencias con transferencias aprobadas', 'success', $vigencias);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener vigencias', 'No se pudieron obtener las vigencias aprobadas', $e->getMessage());
        }
    }

    public function seriesTransferidas($idUnidad, $anio)
    {
        try {
            $archivo = $this->archivosAprobados($idUnidad)->firstWhere('anio_registro_archivo', $anio);
            if (!$archivo) {
                return Responses::warning(404, 'Vigencia no aprobada', "La vigencia {$anio} no tiene transferencias aprobadas.");
            }

            $series = $this->detallesAprobados($archivo->id_archivo)
                ->load(['serie', 'subserie'])
                ->filter(fn ($detalle) => $detalle->serie)
                ->groupBy('id_serie')
                ->map(fn ($detalles) => [
                    'id_serie'     => $detalles->first()->serie->id_serie,
                    'nombre_serie' => $detalles->first()->serie->nombre_serie,
                    'subseries'    => $detalles->pluck('subserie')->filter()->unique('id_subserie')
                        ->map(fn ($subserie) => [
                            'id_subserie'     => $subserie->id_subserie,
                            'nombre_subserie' => $subserie->nombre_subserie,
                        ])->values(),
                ])->values();

            return Responses::success(200, 'Series transferidas', 'Se obtuvieron las series de la transferencia aprobada', 'success', $series);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener series', 'No se pudieron obtener las series transferidas', $e->getMessage());
        }
    }

    public function registrarCajas(array $datos)
    {
        $error = $this->validarCajas($datos['cajas'] ?? []);
        if ($error) {
            return Responses::warning(422, 'Organización de transferencia', $error);
        }

        return $this->registroCajas->registroCajaUnidadActiva($datos);
    }

    public function registrarCarpetas(array $datos)
    {
        $error = $this->validarCarpetas($datos['carpetas'] ?? []);
        if ($error) {
            return Responses::warning(422, 'Organización de transferencia', $error);
        }

        return $this->registroCarpetas->registroCarpetaUnidadActiva($datos);
    }

    /** Cada caja debe pertenecer a una vigencia aprobada y no superar las cajas transferidas. */
    private function validarCajas(array $cajas): ?string
    {
        foreach (collect($cajas)->groupBy(fn ($caja) => $caja['archivoUnidadActiva'] . '|' . $caja['anio']) as $nuevas) {
            $idArchivoUnidad = $nuevas->first()['archivoUnidadActiva'];
            $anio = (string) $nuevas->first()['anio'];

            $idUnidad = ArchivoUnidadActivaModel::where('id_archivo_unidad_activa', $idArchivoUnidad)->value('id_unidad');
            $archivo = $idUnidad ? $this->archivosAprobados($idUnidad)->firstWhere('anio_registro_archivo', $anio) : null;
            if (!$archivo) {
                return "La vigencia {$anio} no tiene transferencias aprobadas.";
            }

            $transferidas = (int) $this->detallesAprobados($archivo->id_archivo)->sum('cantidad_cajas_detalle_transferencia');
            $organizadas = $this->cajasDeVigencia($idArchivoUnidad, $anio)->count();
            if ($organizadas + $nuevas->count() > $transferidas) {
                $disponibles = max($transferidas - $organizadas, 0);
                return "La vigencia {$anio} tiene {$transferidas} caja(s) transferida(s) y solo quedan {$disponibles} por organizar.";
            }
        }

        return null;
    }

    /** La serie/subserie debe estar en la transferencia aprobada y no superar las carpetas transferidas. */
    private function validarCarpetas(array $carpetas): ?string
    {
        $porVigencia = [];

        foreach ($carpetas as $carpeta) {
            $caja = CajaUnidadActivaModel::with('archivo')->find($carpeta['cajaUnidadActiva']);
            $archivo = $caja && $caja->archivo
                ? $this->archivosAprobados($caja->archivo->id_unidad)->firstWhere('anio_registro_archivo', $caja->anio_caja_unidad_activa)
                : null;
            if (!$archivo) {
                return 'La caja seleccionada no pertenece a una vigencia con transferencias aprobadas.';
            }

            $subserie = empty($carpeta['subserie']) ? null : (int) $carpeta['subserie'];
            $transferida = $this->detallesAprobados($archivo->id_archivo)->contains(
                fn ($detalle) => (int) $detalle->id_serie === (int) $carpeta['serie']
                    && ($detalle->id_subserie === null ? null : (int) $detalle->id_subserie) === $subserie
            );
            if (!$transferida) {
                return "La serie/subserie de la carpeta {$carpeta['numeroCarpeta']} no hace parte de la transferencia aprobada de la vigencia {$archivo->anio_registro_archivo}.";
            }

            $porVigencia[$archivo->id_archivo]['archivo'] = $archivo;
            $porVigencia[$archivo->id_archivo]['idArchivoUnidad'] = $caja->id_archivo_unidad_activa;
            $porVigencia[$archivo->id_archivo]['nuevas'] = ($porVigencia[$archivo->id_archivo]['nuevas'] ?? 0) + 1;
        }

        foreach ($porVigencia as $vigencia) {
            $archivo = $vigencia['archivo'];
            $transferidas = (int) $this->detallesAprobados($archivo->id_archivo)->sum('cantidad_carpetas_detalle_transferencia');
            $cajas = $this->cajasDeVigencia($vigencia['idArchivoUnidad'], $archivo->anio_registro_archivo);
            $organizadas = CarpetaUnidadActivaModel::whereIn('id_caja_unidad_activa', $cajas->pluck('id_caja_unidad_activa'))->count();

            if ($organizadas + $vigencia['nuevas'] > $transferidas) {
                $disponibles = max($transferidas - $organizadas, 0);
                return "La vigencia {$archivo->anio_registro_archivo} tiene {$transferidas} carpeta(s) transferida(s) y solo quedan {$disponibles} por organizar.";
            }
        }

        return null;
    }

    /** Archivos (vigencias) de la unidad con al menos una transferencia aprobada. */
    private function archivosAprobados($idUnidad)
    {
        $idDetalle = DetalleUnidadModel::where('id_unidad', $idUnidad)->value('id_detalle');
        if (!$idDetalle) {
            return collect();
        }

        return ArchivoModel::where('id_detalle', $idDetalle)
            ->whereHas('transferencias.solicitudes', fn ($q) => $q->where('estado_solicitud_transferencia', self::SOLICITUD_APROBADA))
            ->orderBy('anio_registro_archivo')
            ->get();
    }

    /** Detalles de las transferencias aprobadas de un archivo (vigencia). */
    private function detallesAprobados($idArchivo)
    {
        return DetalleTransferenciaModel::whereHas('transferencia', function ($q) use ($idArchivo) {
            $q->where('id_archivo', $idArchivo)
                ->whereHas('solicitudes', fn ($s) => $s->where('estado_solicitud_transferencia', self::SOLICITUD_APROBADA));
        })->get();
    }

    private function cajasDeVigencia($idArchivoUnidad, $anio)
    {
        if (!$idArchivoUnidad) {
            return collect();
        }

        return CajaUnidadActivaModel::where('id_archivo_unidad_activa', $idArchivoUnidad)
            ->where('anio_caja_unidad_activa', (string) $anio)
            ->get();
    }
}
