<?php

namespace App\Http\Resources\DocumentacionSistema;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentacionSistemaResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($documentacionSistema){
            return [
                'id_documentacion_sistema' => $documentacionSistema->id_documento_sistema,
                'nombre_documentacion_sistema' => $documentacionSistema->nombre_documento_sistema,
                'descripcion_documentacion_sistema' => $documentacionSistema->tipoDocumentacionSistema->nombre_tipo_documento_sistema ??
                null,
                'id_tipo_documentacion_sistema' => $documentacionSistema->tipoDocumentacionSistema->id_tipo_documentacion_sistema ?? null,
                'ruta_documentacion_sistema' => $documentacionSistema->ruta_documento_sistema,
                'estado_documentacion_sistema' => $documentacionSistema->estados->nombre_estado ?? null,
            ];
        })->toArray();
    }
}
