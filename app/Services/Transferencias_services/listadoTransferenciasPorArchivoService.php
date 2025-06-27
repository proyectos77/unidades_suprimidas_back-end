<?php

    namespace App\Services\Transferencias_services;

use App\Helpers\generalHelper;
use App\Http\Resources\Transferencias\listadoTransferenciasPorArchivoResource;
use App\Http\Responses\Responses;
use App\Models\Transferencias\TransferenciasModel;

    class listadoTransferenciasPorArchivoService
    {
        function getAllTransferencias($idArchivo) {

            try {
                $transferencias = TransferenciasModel::where('id_archivo', $idArchivo)->whereHas('solicitudes', function ($query) {
                    $query->where('estado_solicitud_transferencia', 4);
                })->paginate(10);

                $data = new listadoTransferenciasPorArchivoResource($transferencias);
                $dataPaginacion = generalHelper::infoPagination($transferencias->total(), $transferencias->perPage(), $transferencias->currentPage(), $transferencias->lastPage());

                return Responses::successListado(200, 'Consulta realizada', 'Consulta realizada con éxito', $data, $dataPaginacion);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e);
            }



        }
    }
