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
                'id_unidad'         => $unidades->id_unidad,
                'nombre'            => $unidades->nombre_unidad,
                'sigla'             => $unidades->sigla_unidad,
                'unidad_que_asume_archivo_unidad'             => $unidades->unidad_que_asume_archivo_unidad,
                'departamento'      => $unidades->municipio->departamentos->nombre_departamento,
                'idDepartamento'    => $unidades->municipio->departamentos->id_departamento,
                'municipio'         => $unidades->municipio->nombre_municipio,
                'idMunicipio'       => $unidades->municipio->id_municipio,
                'estado'            => $unidades->estados->nombre_estado,
                'idEstado'          => $unidades->estados->id_estado

            ];
        })->toArray();
    }
}
