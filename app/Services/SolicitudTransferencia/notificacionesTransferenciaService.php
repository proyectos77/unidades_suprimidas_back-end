<?php

    namespace App\Services\SolicitudTransferencia;

use App\Http\Resources\SolicitudesTransferencias\notificacionesResource;
use App\Http\Responses\Responses;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

    class notificacionesTransferenciaService
    {
        public function notificaciones(){
            try {

                //LOCAL
                $conteo = SolicitudTransferenciaModel::selectRaw('
                                COUNT(CASE
                                        WHEN estado_solicitud_transferencia = 3
                                        AND fecha_inicio_solicitud_transferencia = CURDATE()
                                        THEN 1
                                    END) as total_hoy,

                                COUNT(CASE
                                        WHEN estado_solicitud_transferencia = 3
                                        AND fecha_inicio_solicitud_transferencia BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
                                        THEN 1
                                    END) as total_semana,

                                COUNT(CASE
                                        WHEN estado_solicitud_transferencia = 3
                                        AND fecha_inicio_solicitud_transferencia BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()
                                        THEN 1
                                    END) as total_mes
                            ')
                            ->first();

                    //PRODUCCION
                    /* $conteo = SolicitudTransferenciaModel::selectRaw("
                        COUNT(CASE
                            WHEN estado_solicitud_transferencia = 3
                            AND TRUNC(fecha_inicio_solicitud_transferencia) = TRUNC(SYSDATE)
                            THEN 1
                        END) as total_hoy,

                        COUNT(CASE
                            WHEN estado_solicitud_transferencia = 3
                            AND TRUNC(fecha_inicio_solicitud_transferencia)
                                BETWEEN TRUNC(SYSDATE, 'IW') AND TRUNC(SYSDATE)
                            THEN 1
                        END) as total_semana,

                        COUNT(CASE
                            WHEN estado_solicitud_transferencia = 3
                            AND TRUNC(fecha_inicio_solicitud_transferencia)
                                BETWEEN ADD_MONTHS(TRUNC(SYSDATE), -1) AND TRUNC(SYSDATE)
                            THEN 1
                        END) as total_mes
                    ")->first(); */
                $data = new notificacionesResource($conteo);

                return Responses::success(200, 'Consulta realizada', 'Consulta realiza con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e->getMessage());
            }
        }
    }
