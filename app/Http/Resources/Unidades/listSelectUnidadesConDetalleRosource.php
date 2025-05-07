<?php

namespace App\Http\Resources\Unidades;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listSelectUnidadesConDetalleRosource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function($unidades){
            return [
                'id_detalle_unidad' => $unidades->detalleUnidad->id_detalle,
                'nombre_unidad'     => $unidades->nombre_unidad
            ];
        })->toArray();
    }
}
