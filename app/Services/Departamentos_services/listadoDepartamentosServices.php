<?php

    namespace App\Services\Departamentos_services;

use App\Http\Resources\Departamentos\listadoDepartamentosResource;
use App\Http\Responses\Responses;
use App\Models\Departamentos\DepartamentosModel;

    class listadoDepartamentosServices
    {
        public function listadoDepartamentos() {
            try {
                $departamentos = DepartamentosModel::all();
                if (!$departamentos) {
                    return Responses::success('200', 'Sin resultados', 'No se encontraron resultados', 'success');
                }

                $data = new listadoDepartamentosResource($departamentos);
                return Responses::success(200, 'Consulta realizada', 'La consulta se ha realizado con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error de consulta', 'Error al realizar la conuslta', $e->getMessage());
            }
        }
    }

