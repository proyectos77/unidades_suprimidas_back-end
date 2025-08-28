<?php

    namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\listSelectUnidadesConDetalleRosource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use App\Models\Usuarios\UsuariosModel;

    class listadoUnidadesConDetalleServices
    {
        public function listadoUnidadesConDetalle($idDependencia) {

            try {

                $usuariosIds = UsuariosModel::where('id_dependencia', $idDependencia)->pluck('id_usuario');

                $unidades = UnidadesModel::has('detalleUnidad')->whereIn('id_usuario', $usuariosIds)->with('detalleUnidad')->get();
                $data = new listSelectUnidadesConDetalleRosource($unidades);

                return Responses::success(200, 'Consulta realizada', 'Consulta realizada con exito', 'succes', $data);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al consultar', 'error', $e->getMessage());
            }
        }
    }



