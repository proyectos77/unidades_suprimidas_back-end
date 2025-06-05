<?php

    namespace App\Services\Archivo_services;

use App\Helpers\generalHelper;
use App\Http\Resources\Archivo\listadoArchivoPorUnidadResource;
use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;

    class listadoArchivoRegistradoPorUnidad
    {
        public function getArchivosPorUnidad($idDetalle){

            try {

                $archivo = ArchivoModel::with(['detalleUnidad', 'transferencias.solicitudes'])->where('id_detalle', $idDetalle)->paginate(10);

                $data = new listadoArchivoPorUnidadResource($archivo);
                $dataPaginacion = generalHelper::infoPagination($archivo->total(), $archivo->perPage(), $archivo->currentPage(), $archivo->lastPage());

                return Responses::successListado(200, 'Consulta realizada', 'Consulta realizada con éxito', $data, $dataPaginacion);

            } catch (\Throwable $th) {
                //throw $th;
            }


        }
    }

