<?php

    namespace App\Services\SolicitudTransferencia;

use App\Http\Resources\SolicitudesTransferencias\solicitudesTransferenciasResource;
use App\Http\Responses\Responses;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

    class listadoSolicitudesTransferencia
    {
        public function getListadoSolicitudesTransferencias() {

            try {
                $solicitudes = SolicitudTransferenciaModel::with([
                'estadoSolicitud',
                'estado',
                'usuarioSolicitante',
                'usuarioRevisor',
                'transferencia.archivo.detalleUnidad.unidad'
            ])->get();

            $data = new solicitudesTransferenciasResource($solicitudes);
            return Responses::success(200, 'Consulta realizada', 'Consulta realizada con éxito','success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e);
            }
        }
    }
