<?php

namespace App\Http\Resources\DocumentoGeneralFuid;

use App\Http\Resources\CarpetaUnidadActiva\CarpetaUnidadActivaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class registroDetalleDocumentoGeneralFuidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_detalle_documento_general'  => $this->id_detalle_documento_general,
            'id_documento_general'          => $this->id_documento_general,
            'id_carpeta_unidad_activa'      => $this->id_carpeta_unidad_activa,
            'carpeta'                       => new CarpetaUnidadActivaResource($this->whenLoaded('carpetaUnidadActiva')),
            'numero_pagina'                 => $this->numero_pagina,
            'numero_orden'                  => $this->numero_orden,
            'codigo'                        => $this->codigo,
            'nombre_serie_subserie_asunto'  => $this->nombre_serie_subserie_asunto,
            'fecha_extrema_inicio'          => $this->fecha_extrema_inicio,
            'fecha_extrema_fin'             => $this->fecha_extrema_fin,
            'numero_caja'                   => $this->numero_caja,
            'numero_carpeta'                => $this->numero_carpeta,
            'numero_tomo'                   => $this->numero_tomo,
            'numero_otro'                   => $this->numero_otro,
            'numero_folios'                 => $this->numero_folios,
            'numero_soporte'                => $this->numero_soporte,
            'numero_frecuencia_consulta'    => $this->numero_frecuencia_consulta,
            'notas'                         => $this->notas,
            'id_estado'                     => $this->id_estado,
            'estado'                        => $this->estados,
            'fecha_creacion'                => $this->fecha_creacion,
            'fecha_actualizacion'           => $this->fecha_actualizacion,
        ];
    }
}
