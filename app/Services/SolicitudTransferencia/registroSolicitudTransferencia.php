<?php

    namespace App\Services\SolicitudTransferencia;

use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;
use Carbon\Carbon;

    class registroSolicitudTransferencia
    {
        public function registroSolicitud($data, $usuario, $transferencia){
                $solicitud = SolicitudTransferenciaModel::create([
                    'id_transferencia' => $transferencia->id_transferencia,
                    'fecha_inicio_solicitud_transferencia' => Carbon::now(),
                    'id_usuario_solicitante_solicitud_transferencia' => $usuario->id_usuario,
                    'estado_solicitud_transferencia' => 4,
                ]);

                 if(!$solicitud){
                    throw new \Exception('No se puedo realizar el registro de la solicitud.');
                }

                return $solicitud;
        }
    }
