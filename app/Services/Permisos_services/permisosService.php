<?php

    namespace App\Services\Permisos_services;

use App\Http\Responses\Responses;
use App\Models\Permisos\Permisos;

    class PermisosService
    {
        public function listadoPermisos() {
            try {
                $permisos = Permisos::all();

                return Responses::success(200, 'Lista de permisos', 'Se obtuvo la lista de permisos correctamente', 'success', $permisos);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener la lista de permisos', 'Error al obtener la lista de permisos', $e->getMessage());
            }
        }
    }
