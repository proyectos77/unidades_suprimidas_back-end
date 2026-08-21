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
            'ubicacion'                     => $this->construirUbicacion(),
        ];
    }

    /**
     * IDs planos de toda la cadena carpeta -> caja -> balda -> estante -> cuerpo,
     * y unidad -> archivo (independiente de la cadena de estante), para poder
     * navegar directamente al árbol de la unidad correspondiente.
     */
    private function construirUbicacion(): ?array
    {
        $carpeta = $this->carpetaUnidadActiva;

        if (!$carpeta || !$carpeta->relationLoaded('cajaUnidadActiva')) {
            return null;
        }

        $caja = $carpeta->cajaUnidadActiva;
        $balda = $caja && $caja->relationLoaded('balda') ? $caja->balda : null;
        $estante = $balda && $balda->relationLoaded('estante') ? $balda->estante : null;
        $cuerpo = $estante && $estante->relationLoaded('cuerpo') ? $estante->cuerpo : null;
        $archivo = $caja && $caja->relationLoaded('archivo') ? $caja->archivo : null;

        return [
            'idUnidad'  => $archivo->id_unidad ?? null,
            'idCuerpo'  => $cuerpo->id_cuerpo ?? null,
            'idEstante' => $estante->id_estante ?? null,
            'idBalda'   => $balda->id_balda ?? null,
            'idCaja'    => $caja->id_caja_unidad_activa ?? null,
            'idCarpeta' => $carpeta->id_carpeta_unidad_activa ?? null,
        ];
    }
}
