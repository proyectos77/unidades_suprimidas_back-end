<?php

    namespace App\Services\Series_services;

use App\Http\Resources\Series\listadoSeriesResource;
use App\Http\Responses\Responses;
use App\Models\Series\SeriesModel;

    class listadoSeriesServices
    {

        public function listadoSeries($anio) {

            try {
                $series = SeriesModel::where('anio_inicio_serie', '<=', $anio)->where('anio_fin_serie', '>=', $anio)->get();

                $data = new listadoSeriesResource($series);

                return Responses::success(200,'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', 'error', $e->getMessage());
            }
        }

    }
