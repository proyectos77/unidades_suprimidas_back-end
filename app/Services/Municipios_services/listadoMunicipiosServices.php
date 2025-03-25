<?php

    namespace App\Services\Municipios_services;

/* use App\Http\Controllers\Municipios\municipiosController;
use App\Models\Departamentos\DepartamentosModel; */

use App\Http\Resources\Municipios\listadoMunicipiosResource;
use App\Http\Responses\Responses;
use App\Models\Departamentos\DepartamentosModel;
use App\Models\Municipios\MunicipiosModel;

    class listadoMunicipiosServices
    {
        public function listadoMunicipiosPorDepartamento($idDepartamento) {
            try {
                $municipios = DepartamentosModel::where('id_departamento',$idDepartamento)->with('municipios')->get();
                $data = new listadoMunicipiosResource($municipios);

                return Responses::success(200, 'Consulta realizada con exito', 'Listado de municipios del departamento', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }
        }
    }

