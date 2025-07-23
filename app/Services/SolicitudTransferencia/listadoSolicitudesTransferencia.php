<?php

    namespace App\Services\SolicitudTransferencia;

use App\Helpers\generalHelper;
use App\Http\Resources\SolicitudesTransferencias\solicitudesTransferenciasResource;
use App\Http\Responses\Responses;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;

    class listadoSolicitudesTransferencia
    {
        public function getListadoSolicitudesTransferencias($idUsuario, $idTipoUsuario) {

            try {

                $query = SolicitudTransferenciaModel::with([
                    'estadoSolicitud',
                    'estado',
                    'usuarioSolicitante',
                    'usuarioRevisor',
                    'transferencia.archivo.detalleUnidad.unidad',
                    'transferencia.detalleTransferencias'
                ]);

                if ($idTipoUsuario == 2) {
                    $query->where('id_usuario_solicitante_solicitud_transferencia', $idUsuario);
                }

                $query->orderBy('id_solicitud_transferencia', 'desc');
                $solicitudes = $query->paginate(10);

            /* return response()->json($solicitudes); */

            $data = new solicitudesTransferenciasResource($solicitudes);
            $dataPaginacion = generalHelper::infoPagination($solicitudes->total(), $solicitudes->perPage(), $solicitudes->currentPage(), $solicitudes->lastPage());

            return Responses::successListado(200, 'Consulta realizada', 'Consulta realizada con éxito', $data, $dataPaginacion);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e);
            }
        }
    }
