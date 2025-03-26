<?php

    namespace App\Services\Unidades_services;

use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
    use Illuminate\Support\Facades\DB;

    class registroUnidadesServices
    {
        public function registroUnidad($request) {
            DB::beginTransaction();

            try {
                $unidad = UnidadesModel::create($request->all());
                DB::commit();
                return Responses::success(200, 'Registro realizado', 'Se realizo el registro de la unidad correctamente', 'success', $unidad);
            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(500, 'Error de registros', 'Por favor intete mas tarde', $e->getMessage());
            }
        }
    }
