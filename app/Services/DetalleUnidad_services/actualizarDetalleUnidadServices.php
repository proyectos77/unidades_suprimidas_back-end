<?php

    namespace App\Services\DetalleUnidad_services;

use App\Http\Resources\DetalleUnidad\actualizarDetalleUnidad;
use App\Http\Responses\Responses;
use App\Models\DetalleUnidad\DetalleUnidadModel;
use Illuminate\Support\Facades\DB;

    class actualizarDetalleUnidadServices
    {
        public function actualizarDetalle($request, $id){
            DB::beginTransaction();

            try {
                $detalleValidado = $this->validarDetalleUnidad($id);
                $detalleValidado->fill($request->all());
                $detalleValidado->save();

                DB::commit();

                return Responses::success(200, 'Actualizado', 'Detalle de la unidad actualizado correctamente', 'success', new actualizarDetalleUnidad($detalleValidado));
            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al actualizar el detalle de la unidad intentelo mas tarde', $e->getMessage());
            }
        }

        public function validarDetalleUnidad($id){
            return DetalleUnidadModel::findOrFail($id);
        }
    }
