<?php

namespace App\Http\Resources\Unidades;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoUnidadesResource extends ResourceCollection
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
                'id_unidad'     => $unidades->id_unidad,
                'nombre'        => $unidades->nombre_unidad,
                'sigla'         => $unidades->sigla_unidad,
                'padre'         => $unidades->padre_unidad,
                'departamento'  => $unidades->municipio->departamentos->nombre_departamento,
                'municipio'     => $unidades->municipio->nombre_municipio,
                'estado'        => $unidades->estados->nombre_estado
            ];
        })->toArray();
    }
}
