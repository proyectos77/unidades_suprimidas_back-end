<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Dependencias\DependenciasPadresResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class listadoUnidadesPadreActivas
    {
        public function getListadoUnidadesPadreActivas()
        {
            try {
                $unidadesPadreActivas = UnidadesModel::whereNull('padre_unidad')->where('id_estado', '1')->get();

                if ($unidadesPadreActivas->isEmpty()) {
                    return Responses::success(200, 'No se encontraron unidades padre activas', 'No hay unidades padre activas disponibles', 'info', []);
                }

                return Responses::success(200, 'Listado de unidades padre activas', 'Unidades obtenidas correctamente', 'success', $unidadesPadreActivas);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error interno del servidor', 'No se pudo obtener el listado de unidades padre activas', $e);
            }
        }
    }
