<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectUnidadesConArchivoResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use Illuminate\Support\Facades\DB;

    class listadoUnidadesArchivoSevice
    {
        function gatAllUnidadesArchivo(){
    try {
          $unidades = UnidadesModel::whereHas('detalleUnidad.archivo', function ($archivoQuery) {
            $archivoQuery->where(function ($query) {
                // Archivos SIN transferencias
                $query->whereDoesntHave('transferencias');

                // Archivos CON transferencias pero suma de porcentaje < 100 y estado != 5
                $query->orWhereHas('transferencias', function ($q) {
                    $q->join('solicitud_transferencias', 'transferencias.id_transferencia', '=', 'solicitud_transferencias.id_transferencia')
                      ->where('solicitud_transferencias.estado_solicitud_transferencia', '!=', 5)
                      ->select('transferencias.id_archivo')
                      ->groupBy('transferencias.id_archivo')
                      ->havingRaw('SUM(transferencias.porcentaje_transferencia) < 100');
                });
            });
        })
        ->with(['detalleUnidad.archivo'])
        ->get();

            $data = new listSelectUnidadesConArchivoResource($unidades);

            return Responses::success(200, 'Consulta realizada', 'Consulta realizada con éxito', 'success', $data);

        } catch (\Exception $e) {
            // Para depuración, puedes loguear el error

            return Responses::error(500, 'Error', 'Error al consultar', 'error', $e->getMessage());
        }
}

    }
