<?php

namespace App\Services\Usuarios_services;

use App\Http\Resources\Usuarios\listadoUsuariosResource;
use App\Http\Responses\Responses;
use App\Models\Usuarios\UsuariosModel;

    class listadoUsuarios
    {
        public function listaUsuarios() {

            try {

                $usuarios = UsuariosModel::with('cargos')->with('tipoUsuario')->with('estados')->get();

                if ($usuarios->isEmpty()) {
                    return  Responses::success('200', 'Sin resultados', 'No se encontraron usuarios', 'success');
                }

                $data = new listadoUsuariosResource($usuarios);

                return  Responses::success(200, 'Consulta realizada', 'La consulta se ha ralizado con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }

        }
    }
