<?php

namespace App\Services\Balda_services;

use App\Http\Responses\Responses;
use App\Models\Balda\BaldaModel;

class listadoBaldaServices
{
    public function getBaldaPorEstante($idEstante)
    {
        try {
            $baldas = BaldaModel::where('id_estante', $idEstante)->get();

            return Responses::success(200, 'Lista de baldas', 'Se obtuvo la lista de baldas del estante', 'success', $baldas);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener la lista de baldas', 'Error al obtener la lista de baldas', 'error', $e->getMessage());
        }
    }
}
