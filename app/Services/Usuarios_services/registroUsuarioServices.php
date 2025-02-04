<?php

    namespace App\Services\Usuarios_services;

    use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;

    class registroUsuarioServices
    {
        public function gestionRegistroUsuario(registroUsuarioRequest $request) {
            var_dump('hola');
            /* try {
                var_dump($request);
            } catch (\Throwable $th) {

            } */
        }
    }
