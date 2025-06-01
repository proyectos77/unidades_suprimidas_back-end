<?php

    namespace App\Services\SolicitudTransferencia;

use App\Http\Resources\SolicitudesTransferencias\solicitudesTransferenciasResource;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

    class listadoSolicitudesTransferencia
    {
        public function getListadoSolicitudesTransferencias() {

            $solicitudes = SolicitudTransferenciaModel::with([
                'estadoSolicitud',
                'estado',
                'usuarioSolicitante',
                'usuarioRevisor',
                'transferencia.archivo.detalleUnidad.unidad'
            ])->get();


            $data = new solicitudesTransferenciasResource($solicitudes);

            return $data;
            /* return response()->json($solicitudes); */
        }
    }
