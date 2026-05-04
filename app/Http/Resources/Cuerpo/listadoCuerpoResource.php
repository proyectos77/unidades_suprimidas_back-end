<?php

namespace App\Http\Resources\Cuerpo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoCuerpoResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($cuerpo) {
            return [
                'id'     => $cuerpo->id_cuerpo,
                'nombre' => $cuerpo->nombre_cuerpo
            ];
        })->toArray();
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
