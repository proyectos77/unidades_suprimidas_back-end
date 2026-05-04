<?php

namespace App\Http\Resources\Estante;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoEstanteResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($estante) {
            return [
                'id'       => $estante->id_estante,
                'nombre'   => $estante->nombre_estante,
                'idCuerpo' => $estante->id_cuerpo
            ];
        })->toArray();
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
