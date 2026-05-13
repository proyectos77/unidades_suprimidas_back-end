<?php

namespace App\Services\DocumentoUnidadActiva_services;

use App\Http\Responses\Responses;
use App\Models\DocumentoUnidadActiva\DocumentoUnidadActivaModel;

class RegistroDocumentoUnidadActivaService
{
    public function registroDocumentoUnidadActiva($datos)
    {
        try {
            $documentos = $datos['documentos'] ?? [];
            $documentosCreados = [];

            foreach ($documentos as $documentoData) {
                $documentoTransformada = [
                    'id_carpeta_unidad_activa' => $documentoData['carpetaUnidadActiva'] ?? null,
                    'numero_radicado' => $documentoData['numeroRadicado'] ?? null,
                    'fecha_elaboracion' => $documentoData['fechaElaboracion'] ?? null,
                    'id_unidad' => $documentoData['unidad'] ?? null,
                    'nombre_funcionario_destino' => $documentoData['nombreFuncionarioDestino'] ?? null,
                    'asunto' => $documentoData['asunto'] ?? null,
                    'nombre_quien_firma' => $documentoData['nombreQuienFirma'] ?? null,
                    'cargo_quien_firma' => $documentoData['cargoQuienFirma'] ?? null,
                    'tipo_soporte' => $documentoData['tipoSoporte'] ?? null,
                    'cantidad_folios' => $documentoData['cantidadFolios'] ?? null,
                    'tipo_documental' => $documentoData['tipoDocumental'] ?? null,
                    'observaciones' => $documentoData['observaciones'] ?? null,
                    'id_estado' => $documentoData['estado'] ?? 1,
                ];

                $documento = DocumentoUnidadActivaModel::create($documentoTransformada);
                $documentosCreados[] = $documento;
            }

            $mensaje = count($documentosCreados) === 1 ? 'documento' : 'documentos';

            return Responses::success(
                201,
                count($documentosCreados) . ' ' . $mensaje . ' de unidad activa creado(s)',
                'Los documentos de unidad activa se han registrado exitosamente',
                'success',
                $documentosCreados
            );

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Error de base de datos en registroDocumentoUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error de base de datos',
                'Error al registrar los documentos: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            \Log::error('Error general en registroDocumentoUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error al crear documentos de unidad activa',
                'No se pudieron registrar los documentos de unidad activa: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        }
    }

    public function listadoDocumentoUnidadActiva()
    {
        try {
            $documentos = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ])->get();

            $documentosConResumen = $documentos->map(fn($doc) => $this->construirDocumentoConResumen($doc));

            return Responses::success(
                200,
                'Listado de documentos',
                'Se obtuvo la lista de documentos de unidades activas',
                'success',
                $documentosConResumen
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener listado de documentos',
                'Error al obtener la lista de documentos de unidades activas',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentoUnidadActiva($id)
    {
        try {
            $documento = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ])->findOrFail($id);

            $documentoConResumen = $this->construirDocumentoConResumen($documento);

            return Responses::success(
                200,
                'Documento de unidad activa obtenido',
                'Se obtuvo el documento de unidad activa',
                'success',
                $documentoConResumen
            );

        } catch (\Exception $e) {
            return Responses::error(
                404,
                'Documento no encontrado',
                'El documento de unidad activa no existe',
                'error',
                $e->getMessage()
            );
        }
    }

    public function actualizarDocumentoUnidadActiva($id, $datos)
    {
        try {
            $documento = DocumentoUnidadActivaModel::findOrFail($id);

            $documentoTransformada = [
                'id_carpeta_unidad_activa' => $datos['carpetaUnidadActiva'] ?? $documento->id_carpeta_unidad_activa,
                'numero_radicado' => $datos['numeroRadicado'] ?? $documento->numero_radicado,
                'fecha_elaboracion' => $datos['fechaElaboracion'] ?? $documento->fecha_elaboracion,
                'id_unidad' => $datos['unidad'] ?? $documento->id_unidad,
                'nombre_funcionario_destino' => $datos['nombreFuncionarioDestino'] ?? $documento->nombre_funcionario_destino,
                'asunto' => $datos['asunto'] ?? $documento->asunto,
                'nombre_quien_firma' => $datos['nombreQuienFirma'] ?? $documento->nombre_quien_firma,
                'cargo_quien_firma' => $datos['cargoQuienFirma'] ?? $documento->cargo_quien_firma,
                'tipo_soporte' => $datos['tipoSoporte'] ?? $documento->tipo_soporte,
                'cantidad_folios' => $datos['cantidadFolios'] ?? $documento->cantidad_folios,
                'tipo_documental' => $datos['tipoDocumental'] ?? $documento->tipo_documental,
                'observaciones' => $datos['observaciones'] ?? $documento->observaciones,
                'id_estado' => $datos['estado'] ?? $documento->id_estado,
            ];

            $documento->update($documentoTransformada);

            return Responses::success(
                200,
                'Documento de unidad activa actualizado',
                'El documento de unidad activa se ha actualizado exitosamente',
                'success',
                $documento
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al actualizar documento de unidad activa',
                'No se pudo actualizar el documento de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function eliminarDocumentoUnidadActiva($id)
    {
        try {
            $documento = DocumentoUnidadActivaModel::findOrFail($id);
            $documento->delete();

            return Responses::success(
                200,
                'Documento de unidad activa eliminado',
                'El documento de unidad activa se ha eliminado exitosamente',
                'success',
                null
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al eliminar documento de unidad activa',
                'No se pudo eliminar el documento de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorCarpeta($idCarpeta)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ])->where('id_carpeta_unidad_activa', $idCarpeta)->get();

            $documentosConResumen = $documentos->map(fn($doc) => $this->construirDocumentoConResumen($doc));

            return Responses::success(
                200,
                'Listado de documentos por carpeta',
                'Se obtuvo la lista de documentos de la carpeta',
                'success',
                $documentosConResumen
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por carpeta',
                'Error al obtener los documentos de la carpeta',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorUnidad($idUnidad)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ])->where('id_unidad', $idUnidad)->get();

            $documentosConResumen = $documentos->map(fn($doc) => $this->construirDocumentoConResumen($doc));

            return Responses::success(
                200,
                'Listado de documentos por unidad',
                'Se obtuvo la lista de documentos de la unidad',
                'success',
                $documentosConResumen
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por unidad',
                'Error al obtener los documentos de la unidad',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorCarpetaUnidad($idUnidad, $idCarpeta)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ])->where('id_unidad', $idUnidad)
                ->where('id_carpeta_unidad_activa', $idCarpeta)
                ->get();

            $documentosConResumen = $documentos->map(fn($doc) => $this->construirDocumentoConResumen($doc));

            return Responses::success(
                200,
                'Listado de documentos por carpeta',
                'Se obtuvo la lista de documentos de la carpeta',
                'success',
                $documentosConResumen
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por carpeta',
                'Error al obtener los documentos de la carpeta',
                'error',
                $e->getMessage()
            );
        }
    }

    public function filtrarDocumentosUnidadActiva($filtros)
    {
        try {
            $filtrosValidados = $this->validarYPrepararFiltros($filtros);

            if (empty($filtrosValidados)) {
                return Responses::error(
                    400,
                    'Filtros inválidos',
                    'Debe proporcionar al menos un parámetro de búsqueda válido: numeroRadicado, asunto, firmante u observacion',
                    'warning',
                    null
                );
            }

            $query = DocumentoUnidadActivaModel::with([
                'carpeta.serie',
                'carpeta.subserie',
                'carpeta.cajaUnidadActiva.balda.estante.cuerpo',
                'carpeta.cajaUnidadActiva.archivo',
                'unidad',
                'estado'
            ]);

            foreach ($filtrosValidados as $campo => $valor) {
                if ($campo === 'numeroRadicado') {
                    $query->where('numero_radicado', $valor['valor']);
                } elseif ($campo === 'asunto') {
                    $query->where('asunto', 'like', '%' . $valor['valor'] . '%');
                } elseif ($campo === 'firmante') {
                    $query->where('nombre_quien_firma', 'like', '%' . $valor['valor'] . '%');
                } elseif ($campo === 'observacion') {
                    $query->where('observaciones', 'like', '%' . $valor['valor'] . '%');
                }
            }

            $documentos = $query->get();

            if ($documentos->isEmpty()) {
                return Responses::success(
                    200,
                    'Sin resultados',
                    'No se encontraron documentos que coincidan con los criterios de búsqueda',
                    'info',
                    []
                );
            }

            $documentosConResumen = $documentos->map(fn($doc) => $this->construirDocumentoConResumen($doc));

            return Responses::success(
                200,
                'Documentos filtrados',
                'Se obtuvieron ' . count($documentosConResumen) . ' documento(s) que coinciden con los criterios de búsqueda',
                'success',
                $documentosConResumen
            );

        } catch (\Exception $e) {
            \Log::error('Error al filtrar documentos: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error al filtrar documentos',
                'Error al obtener los documentos filtrados de unidades activas',
                'error',
                $e->getMessage()
            );
        }
    }

    private function validarYPrepararFiltros($filtros)
    {
        $camposFiltro = [
            'numeroRadicado' => 'numero_radicado',
            'asunto' => 'asunto',
            'firmante' => 'nombre_quien_firma',
            'observacion' => 'observaciones'
        ];

        $filtrosValidados = [];

        foreach ($camposFiltro as $campoEntrada => $campoDb) {
            if (!isset($filtros[$campoEntrada])) {
                continue;
            }

            $valor = $filtros[$campoEntrada];

            if ($valor === null || $valor === '' || (is_string($valor) && trim($valor) === '')) {
                continue;
            }

            $valor = is_string($valor) ? trim($valor) : $valor;

            if (!empty($valor)) {
                $filtrosValidados[$campoEntrada] = [
                    'campo_db' => $campoDb,
                    'valor' => $valor
                ];
            }
        }

        return $filtrosValidados;
    }

    private function construirDocumentoConResumen($documento)
    {
        $data = $documento->toArray();
        $data['resumen'] = [];

        if ($documento->carpeta) {
            $carpeta = $documento->carpeta;
            $data['resumen']['carpeta'] = [
                'id' => $carpeta->id_carpeta_unidad_activa,
                'numero' => $carpeta->numero_carpeta_unidad_activa,
                'cantidad_folios' => $carpeta->cantidad_folios,
                'fecha_extrema_inicio' => $carpeta->fecha_extrema_inicio,
                'fecha_extrema_fin' => $carpeta->fecha_extrema_fin,
            ];

            if ($carpeta->serie) {
                $data['resumen']['carpeta']['serie'] = [
                    'id' => $carpeta->serie->id_serie ?? $carpeta->serie->id,
                    'nombre' => $carpeta->serie->nombre_serie,
                ];
            }

            if ($carpeta->subserie) {
                $data['resumen']['carpeta']['subserie'] = [
                    'id' => $carpeta->subserie->id_subserie ?? $carpeta->subserie->id,
                    'nombre' => $carpeta->subserie->nombre_subserie,
                ];
            }

            if ($carpeta->cajaUnidadActiva) {
                $caja = $carpeta->cajaUnidadActiva;
                $sumaFoliosCaja = DocumentoUnidadActivaModel::whereHas('carpeta', fn($q) =>
                    $q->where('id_caja_unidad_activa', $caja->id_caja_unidad_activa)
                )->sum('cantidad_folios');

                $data['resumen']['caja'] = [
                    'id' => $caja->id_caja_unidad_activa,
                    'codigo' => $caja->codigo_caja_unidad_activa,
                    'numero_consecutivo' => $caja->numero_consecutivo_bodega_unidad_activa,
                    'numero_correlativo' => $caja->numero_correlativo_dependencia_unidad_activa,
                    'anio' => $caja->anio_caja_unidad_activa,
                    'cantidad_carpetas' => $caja->cantidad_carpetas_unidad_activa,
                    'cantidad_libros' => $caja->cantidad_libros_unidad_activa,
                    'suma_folios_caja' => $sumaFoliosCaja,
                ];

                if ($caja->balda) {
                    $balda = $caja->balda;
                    $sumaFoliosBalda = DocumentoUnidadActivaModel::whereHas('carpeta.cajaUnidadActiva', fn($q) =>
                        $q->where('id_balda', $balda->id_balda)
                    )->sum('cantidad_folios');

                    $totalCajasBalda = \DB::table('cajas_unidad_activas')
                        ->where('id_balda', $balda->id_balda)
                        ->count();

                    $data['resumen']['balda'] = [
                        'id' => $balda->id_balda,
                        'nombre' => $balda->nombre_balda,
                        'total_cajas' => $totalCajasBalda,
                        'suma_folios_balda' => $sumaFoliosBalda,
                    ];

                    if ($balda->estante) {
                        $estante = $balda->estante;
                        $sumaFoliosEstante = DocumentoUnidadActivaModel::whereHas('carpeta.cajaUnidadActiva.balda', fn($q) =>
                            $q->where('id_estante', $estante->id_estante)
                        )->sum('cantidad_folios');

                        $totalBaldas = \DB::table('baldas')
                            ->where('id_estante', $estante->id_estante)
                            ->count();

                        $data['resumen']['estante'] = [
                            'id' => $estante->id_estante,
                            'nombre' => $estante->nombre_estante,
                            'cantidad_baldas' => $totalBaldas,
                            'suma_folios_estante' => $sumaFoliosEstante,
                        ];

                        if ($estante->cuerpo) {
                            $cuerpo = $estante->cuerpo;
                            $sumaFoliosCuerpo = DocumentoUnidadActivaModel::whereHas('carpeta.cajaUnidadActiva.balda.estante', fn($q) =>
                                $q->where('id_cuerpo', $cuerpo->id_cuerpo)
                            )->sum('cantidad_folios');

                            $totalEstantes = \DB::table('estantes')
                                ->where('id_cuerpo', $cuerpo->id_cuerpo)
                                ->count();

                            $data['resumen']['cuerpo'] = [
                                'id' => $cuerpo->id_cuerpo,
                                'nombre' => $cuerpo->nombre_cuerpo,
                                'cantidad_estantes' => $totalEstantes,
                                'suma_folios_cuerpo' => $sumaFoliosCuerpo,
                            ];
                        }
                    }
                }

                if ($caja->archivo) {
                    $archivo = $caja->archivo;
                    $totalCarpetasArchivo = \DB::table('carpetas_unidad_activas')
                        ->whereIn('id_caja_unidad_activa', \DB::table('cajas_unidad_activas')
                            ->where('id_archivo_unidad_activa', $archivo->id_archivo_unidad_activa)
                            ->pluck('id_caja_unidad_activa'))
                        ->count();

                    $sumaFoliosArchivo = DocumentoUnidadActivaModel::whereHas('carpeta.cajaUnidadActiva.archivo', fn($q) =>
                        $q->where('id_archivo_unidad_activa', $archivo->id_archivo_unidad_activa)
                    )->sum('cantidad_folios');

                    $data['resumen']['archivo'] = [
                        'id' => $archivo->id_archivo_unidad_activa,
                        'ubicacion' => $archivo->ubicacion_archivo_unidad_activa,
                        'direccion' => $archivo->direccion_archivo_unidad_activa,
                        'edificio' => $archivo->edificio_archivo_unidad_activa,
                        'piso' => $archivo->piso_archivo_unidad_activa,
                        'bodega' => $archivo->bodega_archivo_unidad_activa,
                        'total_carpetas' => $totalCarpetasArchivo,
                        'suma_folios_archivo' => $sumaFoliosArchivo,
                    ];
                }
            }
        }

        if ($documento->unidad) {
            $unidad = $documento->unidad;
            $sumaFoliosUnidad = DocumentoUnidadActivaModel::where('id_unidad', $unidad->id_unidad)->sum('cantidad_folios');

            $totalCarpetasUnidad = \DB::table('carpetas_unidad_activas')
                ->whereIn('id_caja_unidad_activa', \DB::table('cajas_unidad_activas')
                    ->whereIn('id_archivo_unidad_activa', \DB::table('archivo_unidades_activas')
                        ->where('id_unidad', $unidad->id_unidad)
                        ->pluck('id_archivo_unidad_activa'))
                    ->pluck('id_caja_unidad_activa'))
                ->count();

            $totalCuerposUnidad = \DB::table('cuerpos')->count();

            $data['resumen']['unidad'] = [
                'id' => $unidad->id_unidad,
                'nombre' => $unidad->nombre_unidad,
                'sigla' => $unidad->sigla_unidad,
                'cantidad_cuerpos' => $totalCuerposUnidad,
                'total_carpetas' => $totalCarpetasUnidad,
                'total_folios' => $sumaFoliosUnidad,
            ];
        }

        if ($documento->estado) {
            $data['resumen']['estado'] = [
                'id' => $documento->estado->id_estado,
                'nombre' => $documento->estado->nombre_estado,
            ];
        }

        return $data;
    }
}
