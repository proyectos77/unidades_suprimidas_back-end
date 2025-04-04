<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class selectUnidadesServices
    {
        public function listadoCompletoUnidades() {
            try {
                $unidades = UnidadesModel::all();
                $data = new listSelectResource($unidades);
                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error de consulta', 'Fallo en la consulta', 'error', $e->getMessage());
            }
        }
    }
