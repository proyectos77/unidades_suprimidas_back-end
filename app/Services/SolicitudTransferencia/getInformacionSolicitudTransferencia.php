<?php

    namespace App\Services\SolicitudTransferencia;

use App\Http\Resources\SolicitudesTransferencias\informacionSolicitudTransferenciaResource;
use App\Http\Responses\Responses;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

    class getInformacionSolicitudTransferencia
    {
        public function getInformacion($idSolicitudTransferencia){

            try {
                $solicitud = SolicitudTransferenciaModel::where('id_solicitud_transferencia', $idSolicitudTransferencia)->get();

                $data = new informacionSolicitudTransferenciaResource($solicitud);
                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con éxito', 'success', $data);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e);
            }
        }
    }
