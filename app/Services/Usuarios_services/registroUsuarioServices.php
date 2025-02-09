<?php

    namespace App\Services\Usuarios_services;

    use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;
    use App\Http\Responses\Responses;
    use App\Models\Usuarios\UsuariosModel;
    use Exception;
    use Illuminate\Support\Facades\DB;

    class registroUsuarioServices
    {
        public function gestionRegistroUsuario(registroUsuarioRequest $request) {

            DB::beginTransaction();

            try {
                    $usuario = UsuariosModel::create($request->all());

                    DB::commit();
                    return Responses::success(200, 'Registro realizado', 'Se realizo el registro del usuario correctamente', 'success', $usuario);

                }  catch (Exception $e) {
                    DB::rollBack();
                    return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', $e->getMessage());
            }
        }
    }
