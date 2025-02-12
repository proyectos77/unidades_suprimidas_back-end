<?php

namespace App\Http\Resources\TipoUsuarios;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoTipoUsuariosResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($tipoUsuario){
            return [
                'id'        => $tipoUsuario->id_tipo_usuario,
                'nombre'    => $tipoUsuario->nombre_tipo_usuario
            ];
        })->toArray();
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray(($request)));
    }
}
