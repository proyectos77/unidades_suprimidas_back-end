<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\actualizarUnidadesResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use Illuminate\Support\Facades\DB;

    class updateUnidadServices
    {
        public function actualizarUnidad($request, $id){
            DB::beginTransaction();

            try {
                $unidadValidada =   $this->validarUnidad($id);
                $unidadValidada->fill($request->all());
                $unidadValidada->save();

                DB::commit();

                return Responses::success(200, 'Actializada', 'Unidad actualizada correctamente', 'success', new actualizarUnidadesResource($unidadValidada));

            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al actualizar la unidad, intentelo mas tarde', $e->getMessage());
            }
        }

        public function validarUnidad($id) {
            return UnidadesModel::findOrFail($id);
        }
    }
