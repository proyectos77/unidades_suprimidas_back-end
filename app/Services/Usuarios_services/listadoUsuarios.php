<?php

namespace App\Services\Usuarios_services;

use App\Http\Resources\Usuarios\listadoUsuariosResource;
use App\Models\UsuariosModel;

    class listadoUsuarios
    {
        public function listaUsuarios() {
            $usuarios = UsuariosModel::all();
            /* $h = new listadoUsuariosResource($usuarios);
            return $h; */

            return response()->json($usuarios);

        }
    }
