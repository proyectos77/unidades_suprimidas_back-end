<?php

    namespace App\Services\Unidades_services;

use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class listadoUnidadesHijasActivas
    {
        public function getListadoUnidadesHijasActivas($idUnidadPadre)
        {
            try {

                $unidadesHijasActivas = UnidadesModel::where('padre_unidad', $idUnidadPadre)->where('id_estado', 1)->get();

                if ($unidadesHijasActivas->isEmpty()) {
                    return Responses::success(200, 'No se encontraron unidades hijas activas', 'No hay unidades hijas activas disponibles', 'info', []);
                }

                return Responses::success(200, 'Listado de unidades hijas activas', 'Unidades obtenidas correctamente', 'success', $unidadesHijasActivas);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error interno del servidor', 'No se pudo obtener el listado de unidades hijas activas', $e);
            }
        }
    }
