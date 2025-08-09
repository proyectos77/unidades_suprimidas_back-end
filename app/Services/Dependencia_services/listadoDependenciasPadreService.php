<?php

    namespace App\Services\Dependencia_services;

use App\Http\Resources\Dependencias\DependenciasPadresResource;
use App\Http\Responses\Responses;
use App\Models\Denpendencias\Dependencias;

    class listadoDependenciasPadreService
    {
        public function getListadoDependenciasPadre()
        {
            try {
                $dependenciasPadres = Dependencias::whereNull('padre_dependencia')->get();

                if ($dependenciasPadres->isEmpty()) {
                    throw new \Exception('No se encontraron dependencias padres.');
                }

                 $data = new DependenciasPadresResource($dependenciasPadres);

                return Responses::success(200, 'Listado de dependencias padres', 'Dependencias obtenidas correctamente', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener el listado de dependencias padres', 'Error interno del servidor', 'error', $e->getMessage());
            }
        }
    }
