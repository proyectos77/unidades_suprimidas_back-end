<?php

    namespace App\Services\Subseries_services;

    use App\Http\Resources\Subserie\listadoSubserieResource;
    use App\Http\Responses\Responses;
    use App\Models\Subseries\SubseriesModel;

    class listadoSubseriesPorSerieServices
    {
        public function listadoSubseries($idSerie){

            try {

                $subseries = SubseriesModel::where('id_serie', $idSerie)->get();
                $data = new listadoSubserieResource($subseries);

                return Responses::success(200,'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error en la consulta', 'error', $e->getMessage());
            }

        }

    }
