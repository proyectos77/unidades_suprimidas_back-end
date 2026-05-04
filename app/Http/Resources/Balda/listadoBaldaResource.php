<?php

namespace App\Http\Resources\Balda;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoBaldaResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($balda) {
            return [
                'id'        => $balda->id_balda,
                'nombre'    => $balda->nombre_balda,
                'idEstante' => $balda->id_estante
            ];
        })->toArray();
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
