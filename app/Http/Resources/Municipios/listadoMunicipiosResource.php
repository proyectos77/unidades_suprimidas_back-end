<?php

namespace App\Http\Resources\Municipios;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoMunicipiosResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->flatMap(function ($departamento) {
            return $departamento->municipios->map(function ($municipio) {
                return [
                    'id_municipio'   => $municipio->id_municipio,
                    'nombre_municipio' => $municipio->nombre_municipio,
                ];
            });
        })->toArray();
    }

    public function toResponses($request) {
        return response()->json($this->toArray($request));
    }
}
