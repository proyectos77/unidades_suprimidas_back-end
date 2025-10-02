<?php

    namespace App\Services\Unidades_services;

use App\Helpers\generalHelper;
use App\Http\Resources\DetalleUnidad\consultaObservacionUnidadResource;
use App\Http\Resources\Unidades\listadoUnidadesResource;
use App\Http\Responses\Responses;
use App\Models\DetalleUnidad\DetalleUnidadModel;

    class buscarUnidadesObservacionService
    {
        function buscarObservacion($observacion, $idDependencia) {

            try {
                $unidades = DetalleUnidadModel::where('observacion_detalle', 'LIKE', "%$observacion%")->with(['unidad', 'unidad.estados', 'unidad.municipio.departamentos'])->paginate(10);

                if ($unidades->isEmpty()) {
                    return Responses::warning(404, 'No hay ressultados', 'No se encontraron unidades con la observación proporcionada.', []);
                }


                $data =  consultaObservacionUnidadResource::collection($unidades);
                $dataPaginacion = generalHelper::infoPagination($unidades->total(), $unidades->perPage(), $unidades->currentPage(), $unidades->lastPage());

                return Responses::successListado(200, 'Consulta realizada', 'La consulta se ha realizado con exito', $data, $dataPaginacion);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Ocurrió un error al realizar la consulta.', $e->getMessage());
            }
        }
    }
