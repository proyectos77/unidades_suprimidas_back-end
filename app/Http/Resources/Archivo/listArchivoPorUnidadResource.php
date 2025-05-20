<?php

namespace App\Http\Resources\Archivo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class listArchivoPorUnidadResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function($archivo){
            return [
                'anio'          => $archivo->anio_registro_archivo,
                'id_archivo'    => $archivo->id_archivo
            ];
        })->toArray();
    }
}
