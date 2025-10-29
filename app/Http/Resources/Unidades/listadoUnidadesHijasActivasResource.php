<?php

namespace App\Http\Resources\Unidades;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listadoUnidadesHijasActivasResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_unidad' => $this->id_unidad,
            'nombre_unidad' => $this->nombre_unidad, // 👈 forzamos el nombre correcto
            'unidad_superior_jerarquicamente' => $this->unidad_superior_jerarquicamente,
            'sigla' => $this->sigla,
            'unidad_que_asume_archivo_unidad' => $this->unidad_que_asume_archivo_unidad,
            'departamento' => $this->departamento,
            'idDepartamento' => $this->idDepartamento,
            'municipio' => $this->municipio,
            'idMunicipio' => $this->idMunicipio,
            'estado' => $this->estado,
            'idEstado' => $this->idEstado,
            'padre_unidad' => $this->padre_unidad ? [
                'id_unidad' => $this->padre_unidad->id_unidad,
                'nombre_unidad' => $this->padre_unidad->nombre_unidad, // 👈 también forzamos el nombre correcto en el padre
            ] : null,
        ];
    }
}
