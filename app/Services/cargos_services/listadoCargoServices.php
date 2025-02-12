<?php

    namespace App\Services\cargos_services;

use App\Http\Resources\Cargos\listadoCargosResource;
use App\Http\Responses\Responses;
use App\Models\Cargos\CargosModel;

    class listadoCargoServices
    {
        public function listarCargos() {

            try {
                $listaCargos = CargosModel::all();

                if ($listaCargos->isEmpty()) {
                    return  Responses::success('200', 'Sin resultados', 'No se encontraron cargos', 'success');
                }

                $data = new listadoCargosResource($listaCargos);
                return  Responses::success(200, 'Consulta realizada', 'La consulta se ha ralizado con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }



        }
    }
