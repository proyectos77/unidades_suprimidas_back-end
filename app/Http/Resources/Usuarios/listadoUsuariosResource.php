<?php

namespace App\Http\Resources\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoUsuariosResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($usuario) {
            return [
                'id'            => $usuario->id_usuario,
                'nombre'        => $usuario->nombre_usuario,
                'identificacion' => $usuario->identificacion_usuario,
                'email'         => $usuario->email_usuario,
                'usuario'       => $usuario->user_usuario,
                'estado'        => $usuario->estados->nombre_estado,
                'cargo'         => $usuario->cargos->nombre_cargo,
                'tipoUsuario'   => $usuario->tipoUsuario->nombre_tipo_usuario,
            ];
        })->toArray();
    }

    /**
     * Evitar que Laravel agregue la clave "data".
     */
    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
