<?php

namespace App\Http\Resources\DetalleUnidad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class consultaObservacionUnidadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_unidad' => $this->unidad->id_unidad,
            'nombre' => $this->unidad->nombre_unidad,
            'unidad_superior_jerarquicamente' => $this->unidad->unidad_superior_jerarquicamente_unidad,
            'sigla' => $this->unidad->sigla_unidad,
            'unidad_que_asume_archivo_unidad' => $this->unidad->unidad_que_asume_archivo_unidad,
            'departamento' => $this->unidad->municipio->departamentos->nombre_departamento,
            'idDepartamento' => $this->unidad->municipio->departamentos->id_departamento,
            'municipio' => $this->unidad->municipio->nombre_municipio,
            'idMunicipio' => $this->unidad->municipio->id_municipio,
            'estado' => $this->unidad->estados->nombre_estado,
            'idEstado'          => $this->unidad->estados->id_estado

        ];
    }
}
