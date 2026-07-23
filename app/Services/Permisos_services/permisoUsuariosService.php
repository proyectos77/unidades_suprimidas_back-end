<?php

    namespace App\Services\Permisos_services;

use App\Http\Responses\Responses;
use App\Models\PermisosUsuario\PermisosUsuario;

    class permisoUsuariosService
    {
        public function registroPermisoUsuario(array $data) {

            $permisoUsuario = PermisosUsuario::create([
                'id_usuario' => $data['id_usuario'],
                'id_permiso' => $data['id_permiso']
            ]);

            return Responses::success(200, 'Permiso de usuario registrado', 'El permiso de usuario se ha registrado correctamente', 'success', $permisoUsuario);
        }
    }
