<?php

    namespace App\Services\Detalle_de_transferencia_services;

use App\Http\Resources\DetalleTransferencia\detalleTransferenciaResource;
use App\Http\Responses\Responses;
use App\Models\DetalleTransferencia\DetalleTransferenciaModel;

    class listadoDetalleTransferenciaService
    {
        public function listadoDetalle($idTransferencia){

            try {
                $detalle = DetalleTransferenciaModel::where('id_transferencia', $idTransferencia)->get();

                if($detalle->isEmpty()){
                    throw new \Exception('No se encontraron detalles para la transferencia especificada.');
                }else{
                    $data = new detalleTransferenciaResource($detalle);
                    return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'success', $data);
                }

            } catch (\Exception $e) {
                return Responses::error(500, 'Error en la consulta', 'Error al realizar la consulta', $e->getMessage());
            }
        }
    }
