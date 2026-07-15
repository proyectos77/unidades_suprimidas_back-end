<?php

namespace App\Http\Resources\CarpetaUnidadActiva;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarpetaUnidadActivaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idCarpetaUnidadActiva'                  => $this->id_carpeta_unidad_activa,
            'idCajaUnidadActiva'                     => $this->id_caja_unidad_activa,
            'idSerie'                                => $this->id_serie,
            'idSubserie'                             => $this->id_subserie,
            'numeroCarpetaUnidadActiva'              => $this->numero_carpeta_unidad_activa,
            'labelJerarquico'                        => $this->construirLabelJerarquico(),
            'fechaExtremaInicio'                     => $this->fecha_extrema_inicio,
            'fechaExtremaFin'                        => $this->fecha_extrema_fin,
            'cantidadFolios'                         => $this->cantidad_folios,
            'fechaCreacionCarpetaUnidadActiva'       => $this->fecha_creacion_carpeta_unidad_activa,
            'fechaActualizacionCarpetaUnidadActiva'  => $this->fecha_actualizacion_carpeta_unidad_activa,
            'idEstado'                               => $this->id_estado,
            'cajaUnidadActiva'                       => $this->whenLoaded('cajaUnidadActiva'),
            'serie'                                  => $this->whenLoaded('serie'),
            'subserie'                               => $this->whenLoaded('subserie'),
            'estado'                                 => $this->whenLoaded('estado'),
        ];
    }

    private function construirLabelJerarquico(): string
    {
        $caja = $this->cajaUnidadActiva;

        if (!$caja) {
            return $this->numero_carpeta_unidad_activa;
        }

        $balda = $caja->relationLoaded('balda') ? $caja->balda : null;
        $estante = $balda && $balda->relationLoaded('estante') ? $balda->estante : null;
        $cuerpo = $estante && $estante->relationLoaded('cuerpo') ? $estante->cuerpo : null;

        $partes = [];

        if ($cuerpo) {
            $partes[] = $cuerpo->nombre_cuerpo;
        }

        if ($estante) {
            $partes[] = $estante->nombre_estante;
        }

        if ($balda) {
            $partes[] = $balda->nombre_balda;
        }

        $partes[] = 'Caja ' . $caja->codigo_caja_unidad_activa;
        $partes[] = 'Carpeta ' . $this->numero_carpeta_unidad_activa;

        return implode(' / ', $partes);
    }
}
