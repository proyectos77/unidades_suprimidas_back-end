<?php

    namespace App\Services\Usuarios_services;

    use App\Http\Resources\Usuarios\actualizarUsuarioResource;
    use App\Http\Responses\Responses;
    use App\Models\Usuarios\UsuariosModel;
    use Illuminate\Support\Facades\DB;

    class ActualizarUsuariosServices
    {
        public function actualizarUsuario($request, $id) {
            DB::beginTransaction();

            try {

                $usuarioValidado = $this->validarUsuario($id);
                $usuarioValidado->fill($request->all());
                $usuarioValidado->save();

                DB::commit();

                return Responses::success(200, 'Actualizado', 'Usuario actualizado correctamente', 'success', new actualizarUsuarioResource($usuarioValidado));

            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(500, 'Error', 'Error al actualizar el usuario intentelo mas tarde.', $e->getMessage());
            }
        }

        protected function validarUsuario($id) {
            return UsuariosModel::findOrFail($id);
        }

    }

