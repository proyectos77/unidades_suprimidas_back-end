<?php

    namespace App\Services\Permisos_services;

use App\Http\Responses\Responses;
use App\Models\PermisosUsuario\PermisosUsuario;

    class permisoUsuariosService
    {
        public function registroPermisoUsuario(array $data) {

            try {
                $permisoUsuario = PermisosUsuario::create([
                    'id_usuario' => $data['id_usuario'],
                    'id_permiso' => $data['id_permiso']
                ]);

                return Responses::success(200, 'Permiso de usuario registrado', 'El permiso de usuario se ha registrado correctamente', 'success', $permisoUsuario);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al registrar el permiso de usuario', 'Error al registrar el permiso de usuario', $e->getMessage());
            }
        }
    }
