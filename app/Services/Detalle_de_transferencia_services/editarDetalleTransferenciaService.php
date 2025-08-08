<?php

    namespace App\Services\Detalle_de_transferencia_services;

use App\Http\Responses\Responses;
use App\Models\DetalleTransferencia\DetalleTransferenciaModel;

    class editarDetalleTransferenciaService
    {
        public function editarDetalle($id, $data)
        {

            try {
                $valdiarDetalle = $this->validarDetalle($id);
                $valdiarDetalle->fill($data->all());
                $valdiarDetalle->save();

                return Responses::success(200, 'Actualizado', 'Detalle de transferencia actualizado correctamente', 'success', $valdiarDetalle);
            } catch (\Exception $eh) {
                return Responses::error(500, 'Error', 'No se pudo actualizar el detalle de transferencia', $eh->getMessage());
            }
        }

        protected function validarDetalle($id)
        {
            $detalle = DetalleTransferenciaModel::find($id);
            if (!$detalle) {
                throw new \Exception('El detalle no fue encontrado.');
            }else{
                return $detalle;
            }

        }
    }
