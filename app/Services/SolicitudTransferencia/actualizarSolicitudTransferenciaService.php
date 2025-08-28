<?php

namespace App\Services\SolicitudTransferencia;

use App\Http\Responses\Responses;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

class actualizarSolicitudTransferenciaService
{

    public function actualizarSolicitud($data, $idSolicitud){
        try {

            if ($data['estado_solicitud_transferencia'] === 3) {
                $validarSolicitud = $this->validarSolicitud($idSolicitud);
                $validarSolicitud->update(['estado_solicitud_transferencia' => 3, 'id_usuario_revisor_solicitud_transferencia' => null, 'fecha_fin_solicitud_transferencia' => null, 'fecha_inicio_solicitud_transferencia' => now()]);
                $validarSolicitud->save();
                return Responses::success(200, 'Actualizado', 'Solicitud enviada de nuevo a revisión.', 'success', $validarSolicitud);
            }

            $validarSolicitud = $this->validarSolicitud($idSolicitud);
            $validarSolicitud->fill($data);
            $validarSolicitud->save();

            if($data['estado_solicitud_transferencia'] == 4){
                $mensaje = 'Solicitud de transferencia aprobada';
            }else{
                $mensaje = 'Solicitud de transferencia rechazada';
            }
            return Responses::success(200, 'Actualizado', $mensaje, 'success', $validarSolicitud);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error', 'No se pudo actualizar la solicitud de transferencia', $e->getMessage());
        }
    }

    protected function validarSolicitud($idSolicitud){
        $solicitud = SolicitudTransferenciaModel::find($idSolicitud);

        if (!$solicitud) {
            throw new \Exception('La solicitud no fue encontrada.');
        }else{
            return $solicitud;
        }
    }

}

