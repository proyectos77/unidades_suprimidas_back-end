<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use App\Models\Usuarios\UsuariosModel;

    class selectUnidadesServices
    {
        public function listadoCompletoUnidades($idDependencia) {
            try {

                $usuariosIds = UsuariosModel::where('id_dependencia', $idDependencia)->pluck('id_usuario');

                $unidades = UnidadesModel::doesntHave('detalleUnidad')->whereIn('id_usuario', $usuariosIds)->with('detalleUnidad')->get();
                $data = new listSelectResource($unidades);
                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error de consulta', 'Fallo en la consulta', 'error', $e->getMessage());
            }
        }
    }
