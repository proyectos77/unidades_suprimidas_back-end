<?php

namespace App\Http\Resources\Unidades;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listSelectResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($unidades){
            return [
                'id_unidad'         => $unidades->id_unidad,
                'nombre'            => $unidades->nombre_unidad,
            ];
        })->toArray();
    }
}
