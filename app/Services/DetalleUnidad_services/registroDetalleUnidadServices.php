<?php

    namespace App\Services\DetalleUnidad_services;

use App\Http\Responses\Responses;
use App\Models\DetalleUnidad\DetalleUnidadModel;
use Illuminate\Support\Facades\DB;

    class registroDetalleUnidadServices
    {
        public function registroDetalleUnidad($request) {
            DB::beginTransaction();

            try {
                $detalleUnidad = DetalleUnidadModel::create($request->all());
                DB::commit();
                return Responses::success(200, 'Registro realizado', 'Se realizo el registro del detalle de la unidad', 'success', $detalleUnidad);
            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', $e->getMessage());
            }
        }
    }
