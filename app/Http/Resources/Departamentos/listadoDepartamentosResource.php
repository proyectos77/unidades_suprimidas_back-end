<?php

namespace App\Http\Resources\Departamentos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoDepartamentosResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($departamentos){
            return [
                'id'        => $departamentos->id_departamento,
                'nombre'    => $departamentos->nombre_departamento
            ];
        })->toArray();
    }

    public function toResponse($request) {
        return response()->json($this->toArray($request));
    }
}
