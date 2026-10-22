<?php

namespace App\Http\Resources\CajaUnidadActiva;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CajaUnidadActivaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idCajaUnidadActiva'                        => $this->id_caja_unidad_activa,
            'idArchivoUnidadActiva'                     => $this->id_archivo_unidad_activa,
            'idBalda'                                   => $this->id_balda,
            'codigoCajaUnidadActiva'                    => $this->codigo_caja_unidad_activa,
            'numeroConsecutivoBodegaUnidadActiva'       => $this->numero_consecutivo_bodega_unidad_activa,
            'numeroCorrelativoDependenciaUnidadActiva'  => $this->numero_correlativo_dependencia_unidad_activa,
            'anioCajaUnidadActiva'                      => $this->anio_caja_unidad_activa,
            'cantidadLibrosUnidadActiva'                => $this->cantidad_libros_unidad_activa,
            'cantidadCarpetasUnidadActiva'              => $this->cantidad_carpetas_unidad_activa,
            'fechaCreacionArchivoUnidadActiva'          => $this->fecha_creacion_archivo_unidad_activa,
            'fechaActualizacionArchivoUnidadActiva'     => $this->fecha_actualizacion_archivo_unidad_activa,
            'idEstado'                                  => $this->id_estado,
            'cantidadCarpetasRegistradas'               => $this->whenCounted('carpetas'),
            'cajaCompleta'                              => $this->whenCounted('carpetas', fn ($registradas) => $registradas >= (int) $this->cantidad_carpetas_unidad_activa),
            'archivo'                                   => $this->whenLoaded('archivo'),
            'balda'                                     => $this->whenLoaded('balda'),
            'estado'                                    => $this->whenLoaded('estado'),
        ];
    }
}
