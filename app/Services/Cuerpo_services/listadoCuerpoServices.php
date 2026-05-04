<?php

namespace App\Services\Cuerpo_services;

use App\Http\Responses\Responses;
use App\Models\Cuerpo\CuerpoModel;

class listadoCuerpoServices
{
    public function getAllCuerpo()
    {
        try {
            $cuerpos = CuerpoModel::all();

            return Responses::success(200, 'Lista de cuerpos', 'Se obtuvo la lista de cuerpos correctamente', 'success', $cuerpos);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener la lista de cuerpos', 'Error al obtener la lista de cuerpos', 'error', $e->getMessage());
        }
    }
}
