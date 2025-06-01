<?php

namespace App\Http\Resources\SolicitudesTransferencias;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class solicitudesTransferenciasResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
         return $this->collection->map(function ($solicitud){
            return [
                'idSolicitudTransferencia' => $solicitud->id_solicitud_transferencia,
                'fechaSolicitud' => $solicitud->fecha_inicio_solicitud_transferencia,
                'estadoSolicitud' => $solicitud->estadoSolicitud?->nombre_estado,
                'estado' => $solicitud->estado?->nombre_estado,
                'usuarioSolicita' => $solicitud->usuarioSolicitante?->nombre_usuario ?? null,
                'cantidadCajas' => $solicitud->transferencia?->cantidad_cajas_transferencia ?? null,
                'cantidadCarpetas' => $solicitud->transferencia?->cantidad_carpetas_transferencia ?? null,
                'cantidadFolios' => $solicitud->transferencia?->cantidad_folios_transferencia ?? null,
                'porcentajeTransferencia' => $solicitud->transferencia?->porcentaje_transferencia ?? null,
                'anio' => $solicitud->transferencia?->archivo?->anio_registro_archivo ?? null,
                'unidad' => $solicitud->transferencia?->archivo?->detalleUnidad?->unidad?->nombre_unidad ?? null,
            ];
        })->toArray();
    }


    public function toResponse($request)
     {
         return response()->json($this->toArray($request));
     }
}
