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
          $unidades = UnidadesModel::whereHas('detalleUnidad.archivo', function ($query) {
                $query->where(function ($archivoQuery) {
                    // No hay ninguna transferencia asociada al archivo
                    $archivoQuery->whereNotExists(function ($sub1) {
                        $sub1->select(DB::raw(1))
                            ->from('transferencias')
                            ->whereColumn('transferencias.id_archivo', 'archivo.id_archivo');
                    });

                    // O hay transferencias pero la suma de porcentaje es < 100
                    $archivoQuery->orWhereExists(function ($sub2) {
                        $sub2->select(DB::raw(1))
                            ->from('transferencias')
                            ->join('solicitud_transferencias', 'transferencias.id_transferencia', '=', 'solicitud_transferencias.id_transferencia')
                            ->whereColumn('transferencias.id_archivo', 'archivo.id_archivo')
                            ->where('solicitud_transferencias.estado_solicitud_transferencia', '!=5')
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
