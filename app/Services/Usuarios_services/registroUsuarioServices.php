<?php

    namespace App\Services\Usuarios_services;

    use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;
    use App\Http\Responses\Responses;
    use App\Models\UsuariosModel;
    use Exception;
    class registroUsuarioServices
    {
        public function gestionRegistroUsuario(registroUsuarioRequest $request) {
           try {

                $usuario = UsuariosModel::create($request->all());
                if (!$usuario) {
                    throw new \InvalidArgumentException('No se pudo realizar el registro');
                }

                return Responses::success(200, 'Registro realizado', 'Se realizo el registro del usuario correctamente', 'success', $usuario);

           } catch (Exception $e) {
                return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', 'error', $e->getMessage());
           }
        }
    }
