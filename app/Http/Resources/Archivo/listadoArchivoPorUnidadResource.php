<?php

namespace App\Http\Resources\Archivo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoArchivoPorUnidadResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($archivo) {
                // Información de archivo
                $archivoData = [
                    'id_archivo' => $archivo->id_archivo,
                    'anio_registro_archivo' => $archivo->anio_registro_archivo,
                    'numero_cajas_archivos' => $archivo->numero_cajas_archivos,
                    'numero_carpetas_archivo' => $archivo->numero_carpetas_archivo,
                    'numero_folios_archivo' => $archivo->numero_folios_archivo,
                    'numero_tomos_archivo' => $archivo->numero_tomos_archivo ?? 0, // Asumiendo que tomos se relaciona con cajas
                    'numero_otros_archivo' => $archivo->numero_otros_archivo ?? 0, // Asumiendo que otros se relaciona con carpetas
                ];

                // Inicializar sumatorias de transferencias válidas
                $transferenciaStats = [
                    'cantidad_cajas_transferencia' => 0,
                    'cantidad_carpetas_transferencia' => 0,
                    'cantidad_folios_transferencia' => 0,
                    'porcentaje_transferencia' => 0,
                    'cantidad_tomos_transferencia' => 0, // Asumiendo que tomos se relaciona con cajas
                    'cantidad_otros_transferencia' => 0, // Asumiendo que otros se relaciona con carpetas
                ];

                foreach ($archivo->transferencias as $transferencia) {
                    $tieneSolicitudAprobada = collect($transferencia->solicitudes)->contains(fn($solicitud) => $solicitud['estado_solicitud_transferencia'] == 4);

                    if ($tieneSolicitudAprobada) {
                        $transferenciaStats['cantidad_cajas_transferencia'] += $transferencia->cantidad_cajas_transferencia ?? 0;
                        $transferenciaStats['cantidad_carpetas_transferencia'] += $transferencia->cantidad_carpetas_transferencia ?? 0;
                        $transferenciaStats['cantidad_folios_transferencia'] += $transferencia->cantidad_folios_transferencia ?? 0;
                        $transferenciaStats['porcentaje_transferencia'] += (float)$transferencia->porcentaje_transferencia ?? 0;
                        $transferenciaStats['cantidad_tomos_transferencia'] += $transferencia->cantidad_tomos_transferencia ?? 0; // Asumiendo que tomos se relaciona con cajas
                        $transferenciaStats['cantidad_otros_transferencia'] += $transferencia->cantidad_otros_transferencia ?? 0; // Asumiendo que otros se relaciona con carpetas
                    }
                }

                $faltante = [
                    'cantidad_cajas_faltante' => $archivo->numero_cajas_archivos - $transferenciaStats['cantidad_cajas_transferencia'],
                    'cantidad_carpetas_faltante' => $archivo->numero_carpetas_archivo - $transferenciaStats['cantidad_carpetas_transferencia'],
                    'cantidad_folios_faltante' => $archivo->numero_folios_archivo - $transferenciaStats['cantidad_folios_transferencia'],
                    'porcentaje_faltante' => 100 - $transferenciaStats['porcentaje_transferencia'],
                    'cantidad_tomos_faltante' => $archivo->numero_tomos_archivo - $transferenciaStats['cantidad_tomos_transferencia'], // Asumiendo que tomos se relaciona con cajas
                    'cantidad_otros_faltante' => $archivo->numero_otros_archivo - $transferenciaStats['cantidad_otros_transferencia'], // Asumiendo que otros se relaciona con carpetas
                ];

                // Combinar los datos
                return array_merge($archivoData, $transferenciaStats, $faltante);
        })->toArray();
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
