<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectUnidadesConDetalleRosource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class listadoUnidadesConDetalleServices
    {
        public function listadoUnidadesConDetalle(){

            try {
                $unidades = UnidadesModel::has('detalleUnidad')->with('detalleUnidad')->get();
                $data = new listSelectUnidadesConDetalleRosource($unidades);

                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'succes', $data);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al consultar', 'error', $e->getMessage());
            }
        }
    }



