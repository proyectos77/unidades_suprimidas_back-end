<?php

    namespace App\Services\Archivo_services;

    use App\Http\Resources\Archivo\listArchivoPorUnidadResource;
    use App\Http\Responses\Responses;
    use App\Models\Archivo\ArchivoModel;

    class listArchivoPorUnidadServices
    {
        public function getAllArchivoPorUnidad($idDetalleUnidad){

            try {
                $archivo = ArchivoModel::where('id_detalle', $idDetalleUnidad)->get();

                $data = new listArchivoPorUnidadResource($archivo);

                return Responses::success(200, 'Lista de archivos', 'Se obtuvo la lista de archivos por unidad', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener la lista de archivos', 'Error al obtener la lista de archivos por unidad', 'error', $e->getMessage());
            }


        }
    }
