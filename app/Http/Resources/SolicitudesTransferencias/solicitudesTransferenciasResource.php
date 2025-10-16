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
        return $this->collection->map(function ($solicitud) {
            // Consolidar totales de los detalles
            $totales = [
                'cantidadCajas' => 0,
                'cantidadCarpetas' => 0,
                'cantidadFolios' => 0,
                'porcentajeTransferencia' => 0,
                'otros' => 0,
            ];
            $secciones = [];
            $series = [];
            $subseries = [];
            if ($solicitud->transferencia?->detalleTransferencias) {
                foreach ($solicitud->transferencia->detalleTransferencias as $detalle) {
                    $totales['cantidadCajas'] += $detalle->cantidad_cajas_detalle_transferencia;
                    $totales['cantidadCarpetas'] += $detalle->cantidad_carpetas_detalle_transferencia;
                    $totales['cantidadFolios'] += $detalle->cantidad_folios_detalle_transferencia;
                    $totales['porcentajeTransferencia'] += $detalle->porcentaje_detalle_transferencia;
                    $totales['otros'] += $detalle->cantidad_otros_detalle_transferencia;
                    if ($detalle->seccion_detalle_transferencia) {
                        $secciones[] = $detalle->seccion_detalle_transferencia;
                    }
                    if ($detalle->serie_detalle_transferencia) {
                        $series[] = $detalle->serie_detalle_transferencia;
                    }
                    if ($detalle->subserie_detalle_transferencia) {
                        $subseries[] = $detalle->subserie_detalle_transferencia;
                    }
                }
            }
            return [
                'idSolicitudTransferencia' => $solicitud->id_solicitud_transferencia,
                'idTransferencia' => $solicitud->id_transferencia,
                'fechaSolicitud' => $solicitud->fecha_inicio_solicitud_transferencia,
                'estadoSolicitud' => $solicitud->estadoSolicitud?->nombre_estado,
                'idEstado' => $solicitud->estadoSolicitud?->id_estado,
                'estado' => $solicitud->estado?->nombre_estado,
                'usuarioSolicita' => $solicitud->usuarioSolicitante?->nombre_usuario ?? null,
                'idUsuarioSolicita' => $solicitud->usuarioSolicitante?->id_usuario ?? null,
                'usuarioRevisor' => $solicitud->usuarioRevisor?->nombre_usuario ?? null,
                'idUsuarioRevisor' => $solicitud->usuarioRevisor?->id_usuario ?? null,
                'fechaFinSolicitud' => $solicitud->fecha_fin_solicitud_transferencia,
                'anio' => $solicitud->transferencia?->archivo?->anio_registro_archivo ?? null,
                'unidad' => $solicitud->transferencia?->archivo?->detalleUnidad?->unidad?->nombre_unidad ?? null,
                'dependencia' => $solicitud->transferencia?->archivo?->detalleUnidad?->unidad?->usuario?->dependencia?->nombre_dependencia ?? null,
                // Totales consolidados
                'totalCajas' => $totales['cantidadCajas'],
                'totalCarpetas' => $totales['cantidadCarpetas'],
                'totalFolios' => $totales['cantidadFolios'],
                'totalPorcentajeTransferencia' => $totales['porcentajeTransferencia'],
                'totalOtros' => $totales['otros'],
                'descripcionOtros' => $solicitud->transferencia?->detalletransferencia->descripcion_otro_detalle_transferencia ?? null,
                // Si quieres mostrar todas las secciones, series y subseries involucradas
                'secciones' => array_unique($secciones),
                'series' => array_unique($series),
                'subseries' => array_unique($subseries),
            ];
        })->toArray();
    }


    public function toResponse($request)
     {
         return response()->json($this->toArray($request));
     }
}
