<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectUnidadesConArchivoResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class listadoUnidadesArchivoSevice
    {
        function gatAllUnidadesArchivo(){
            try {
                $unidades = UnidadesModel::whereHas('detalleUnidad.archivo')->with(['detalleUnidad' => function($query){
                    $query->with('archivo');
                }])->get();

                $data = new listSelectUnidadesConArchivoResource($unidades);

                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al consultar', 'error', $e->getMessage());
            }
        }
    }
