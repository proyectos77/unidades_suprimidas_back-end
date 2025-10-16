<?php

    namespace App\Services\Ortros;

use App\Http\Resources\Otros\listadoOtrosResource;
use App\Http\Responses\Responses;
use App\Models\TiposOtros\tipoOtrosModel;

    class listadoOtrosServices
    {
        public function getListadoOtros() {

            try {
                $otros = tipoOtrosModel::all();

                $data = new listadoOtrosResource($otros);

                return Responses::success(200, 'Consulta resalizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error del servidor', 'Ha ocurrido un error en el servidor', 'error', $e->getMessage());
            }




        }
    }
