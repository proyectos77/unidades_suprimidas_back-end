<?php

namespace App\Http\Resources\DocumentoGeneralFuid;

use App\Http\Resources\CajaUnidadActiva\CajaUnidadActivaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class registroDocumentoGeneralFuidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_documento_general'      => $this->id_documento_general,
            'id_caja_unidad_activa'     => $this->id_caja_unidad_activa,
            'caja'                      => new CajaUnidadActivaResource($this->whenLoaded('cajaUnidadActiva')),
            'nombre_documento_general'  => $this->nombre_documento_general,
            'url_documento'             => $this->url_documento,
            'id_estado'                 => $this->id_estado,
            'estado'                    => $this->estados,
            'detalles'                  => registroDetalleDocumentoGeneralFuidResource::collection($this->whenLoaded('detalles')),
            'fecha_creacion'            => $this->fecha_creacion,
            'fecha_actualizacion'       => $this->fecha_actualizacion,
        ];
    }
}
