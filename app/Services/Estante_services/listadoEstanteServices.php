<?php

namespace App\Services\Estante_services;

use App\Http\Responses\Responses;
use App\Models\Estante\EstanteModel;

class listadoEstanteServices
{
    public function getEstantePorCuerpo($idCuerpo)
    {
        try {
            $estantes = EstanteModel::where('id_cuerpo', $idCuerpo)->get();

            return Responses::success(200, 'Lista de estantes', 'Se obtuvo la lista de estantes del cuerpo', 'success', $estantes);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener la lista de estantes', 'Error al obtener la lista de estantes', 'error', $e->getMessage());
        }
    }
}
