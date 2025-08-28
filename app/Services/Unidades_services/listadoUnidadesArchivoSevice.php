<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectUnidadesConArchivoResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use App\Models\Usuarios\UsuariosModel;
use Illuminate\Support\Facades\DB;

    class listadoUnidadesArchivoSevice
    {
       public function gatAllUnidadesArchivo($idDependencia){
            try {

                $usuariosIds = UsuariosModel::where('id_dependencia', $idDependencia)->pluck('id_usuario');

                $unidades = UnidadesModel::whereHas('detalleUnidad.archivo', function ($archivoQuery) {
                    $archivoQuery->where(function ($query) {
                        // Archivos SIN transferencias
                        $query->whereDoesntHave('transferencias');

                        // Archivos CON transferencias con porcentaje acumulado < 100 y estado de solicitud != 5
                        $query->orWhereHas('transferencias', function ($q) {
                            $q->join('detalle_transferencia', 'transferencias.id_transferencia', '=', 'detalle_transferencia.id_transferencia')
                            ->join('solicitud_transferencias', 'transferencias.id_transferencia', '=', 'solicitud_transferencias.id_transferencia')
                            ->where('solicitud_transferencias.estado_solicitud_transferencia', '!=', 5)
                            ->select('transferencias.id_archivo')
                            ->groupBy('transferencias.id_archivo')
                            ->havingRaw('SUM(detalle_transferencia.porcentaje_detalle_transferencia) < 100');
                        });
                    });
                })
                ->whereIn('id_usuario', $usuariosIds)
                ->with(['detalleUnidad.archivo'])
                ->get();

                $data = new listSelectUnidadesConArchivoResource($unidades);

                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con éxito', 'success', $data);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al consultar', 'error', $e->getMessage());
            }
        }


    }
