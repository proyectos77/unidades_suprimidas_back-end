<?php

namespace App\Http\Resources\Cargos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoCargosResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($cargos){
            return [
                'id'        => $cargos->id_cargo,
                'nombre'    => $cargos->nombre_cargo
            ];

        })->toArray();
    }


    public function toResponse($request)
    {
        return response()->json($this->toArray(($request)));
    }

}
