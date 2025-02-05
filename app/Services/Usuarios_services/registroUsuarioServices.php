<?php

    namespace App\Services\Usuarios_services;

    use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;

    use App\Models\UsuariosModel;
    use Exception;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;



    class registroUsuarioServices
    {
        public function gestionRegistroUsuario(registroUsuarioRequest $request) {
           try {

                $usuario = UsuariosModel::create($request->all());
                if (!$usuario) {
                    throw new \InvalidArgumentException('No se pudo realizar el registro');
                }

                $token = $usuario->createToken('registro_apiToeken')->plainTextToken;

                return response()->json(['data' => $usuario, 'token' => $token, 'typeToken' => 'Bearer']);

           } catch (Exception $e) {
                return $e->getMessage();
           }
        }
    }
