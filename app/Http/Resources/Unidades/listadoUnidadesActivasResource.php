<?php

namespace App\Http\Resources\Unidades;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoUnidadesActivasResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($unidad){
            return [
                'id_unidad'                                 => $unidad->id_unidad,
                'nombre'                                    => $unidad->nombre_unidad,
                'unidad_superior_jerarquicamente'           => $unidad->unidad_superior_jerarquicamente_unidad,
                'sigla'                                     => $unidad->sigla_unidad,
                'unidad_que_asume_archivo_unidad'           => $unidad->unidad_que_asume_archivo_unidad,
                'departamento'                              => $unidad->municipio?->departamentos?->nombre_departamento,
                'idDepartamento'                            => $unidad->municipio?->departamentos?->id_departamento,
                'municipio'                                 => $unidad->municipio?->nombre_municipio,
                'idMunicipio'                               => $unidad->municipio?->id_municipio,
                'estado'                                    => $unidad->estados->nombre_estado,
                'idEstado'                                  => $unidad->estados->id_estado,
                'padre_unidad'                              => $unidad->padre ? [
                    'id_unidad'                             => $unidad->padre->id_unidad,
                    'nombre_unidad'                         => $unidad->padre->nombre_unidad,
                ] : null,
                'id_detalle'                                => $unidad->detalleUnidad?->id_detalle,

            ];
        })->toArray();
    }
}
