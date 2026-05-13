<?php

namespace App\Services\DocumentoUnidadActiva_services;

use App\Http\Responses\Responses;
use App\Models\DocumentoUnidadActiva\DocumentoUnidadActivaModel;

class RegistroDocumentoUnidadActivaService
{
    public function registroDocumentoUnidadActiva($datos)
    {
        try {
            $documentos = $datos['documentos'] ?? [];
            $documentosCreados = [];

            foreach ($documentos as $documentoData) {
                $documentoTransformada = [
                    'id_carpeta_unidad_activa' => $documentoData['carpetaUnidadActiva'] ?? null,
                    'numero_radicado' => $documentoData['numeroRadicado'] ?? null,
                    'fecha_elaboracion' => $documentoData['fechaElaboracion'] ?? null,
                    'id_unidad' => $documentoData['unidad'] ?? null,
                    'nombre_funcionario_destino' => $documentoData['nombreFuncionarioDestino'] ?? null,
                    'asunto' => $documentoData['asunto'] ?? null,
                    'nombre_quien_firma' => $documentoData['nombreQuienFirma'] ?? null,
                    'cargo_quien_firma' => $documentoData['cargoQuienFirma'] ?? null,
                    'tipo_soporte' => $documentoData['tipoSoporte'] ?? null,
                    'cantidad_folios' => $documentoData['cantidadFolios'] ?? null,
                    'tipo_documental' => $documentoData['tipoDocumental'] ?? null,
                    'observaciones' => $documentoData['observaciones'] ?? null,
                    'id_estado' => $documentoData['estado'] ?? 1,
                ];

                $documento = DocumentoUnidadActivaModel::create($documentoTransformada);
                $documentosCreados[] = $documento;
            }

            $mensaje = count($documentosCreados) === 1 ? 'documento' : 'documentos';

            return Responses::success(
                201,
                count($documentosCreados) . ' ' . $mensaje . ' de unidad activa creado(s)',
                'Los documentos de unidad activa se han registrado exitosamente',
                'success',
                $documentosCreados
            );

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Error de base de datos en registroDocumentoUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error de base de datos',
                'Error al registrar los documentos: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            \Log::error('Error general en registroDocumentoUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error al crear documentos de unidad activa',
                'No se pudieron registrar los documentos de unidad activa: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        }
    }

    public function listadoDocumentoUnidadActiva()
    {
        try {
            $documentos = DocumentoUnidadActivaModel::all();

            return Responses::success(
                200,
                'Listado de documentos',
                'Se obtuvo la lista de documentos de unidades activas',
                'success',
                $documentos
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener listado de documentos',
                'Error al obtener la lista de documentos de unidades activas',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentoUnidadActiva($id)
    {
        try {
            $documento = DocumentoUnidadActivaModel::findOrFail($id);

            return Responses::success(
                200,
                'Documento de unidad activa obtenido',
                'Se obtuvo el documento de unidad activa',
                'success',
                $documento
            );

        } catch (\Exception $e) {
            return Responses::error(
                404,
                'Documento no encontrado',
                'El documento de unidad activa no existe',
                'error',
                $e->getMessage()
            );
        }
    }

    public function actualizarDocumentoUnidadActiva($id, $datos)
    {
        try {
            $documento = DocumentoUnidadActivaModel::findOrFail($id);

            $documentoTransformada = [
                'id_carpeta_unidad_activa' => $datos['carpetaUnidadActiva'] ?? $documento->id_carpeta_unidad_activa,
                'numero_radicado' => $datos['numeroRadicado'] ?? $documento->numero_radicado,
                'fecha_elaboracion' => $datos['fechaElaboracion'] ?? $documento->fecha_elaboracion,
                'id_unidad' => $datos['unidad'] ?? $documento->id_unidad,
                'nombre_funcionario_destino' => $datos['nombreFuncionarioDestino'] ?? $documento->nombre_funcionario_destino,
                'asunto' => $datos['asunto'] ?? $documento->asunto,
                'nombre_quien_firma' => $datos['nombreQuienFirma'] ?? $documento->nombre_quien_firma,
                'cargo_quien_firma' => $datos['cargoQuienFirma'] ?? $documento->cargo_quien_firma,
                'tipo_soporte' => $datos['tipoSoporte'] ?? $documento->tipo_soporte,
                'cantidad_folios' => $datos['cantidadFolios'] ?? $documento->cantidad_folios,
                'tipo_documental' => $datos['tipoDocumental'] ?? $documento->tipo_documental,
                'observaciones' => $datos['observaciones'] ?? $documento->observaciones,
                'id_estado' => $datos['estado'] ?? $documento->id_estado,
            ];

            $documento->update($documentoTransformada);

            return Responses::success(
                200,
                'Documento de unidad activa actualizado',
                'El documento de unidad activa se ha actualizado exitosamente',
                'success',
                $documento
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al actualizar documento de unidad activa',
                'No se pudo actualizar el documento de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function eliminarDocumentoUnidadActiva($id)
    {
        try {
            $documento = DocumentoUnidadActivaModel::findOrFail($id);
            $documento->delete();

            return Responses::success(
                200,
                'Documento de unidad activa eliminado',
                'El documento de unidad activa se ha eliminado exitosamente',
                'success',
                null
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al eliminar documento de unidad activa',
                'No se pudo eliminar el documento de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorCarpeta($idCarpeta)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::where('id_carpeta_unidad_activa', $idCarpeta)->get();

            return Responses::success(
                200,
                'Listado de documentos por carpeta',
                'Se obtuvo la lista de documentos de la carpeta',
                'success',
                $documentos
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por carpeta',
                'Error al obtener los documentos de la carpeta',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorUnidad($idUnidad)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::where('id_unidad', $idUnidad)->get();

            return Responses::success(
                200,
                'Listado de documentos por unidad',
                'Se obtuvo la lista de documentos de la unidad',
                'success',
                $documentos
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por unidad',
                'Error al obtener los documentos de la unidad',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerDocumentosPorCarpetaUnidad($idUnidad, $idCarpeta)
    {
        try {
            $documentos = DocumentoUnidadActivaModel::where('id_unidad', $idUnidad)
                ->where('id_carpeta_unidad_activa', $idCarpeta)
                ->get();

            return Responses::success(
                200,
                'Listado de documentos por carpeta',
                'Se obtuvo la lista de documentos de la carpeta',
                'success',
                $documentos
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener documentos por carpeta',
                'Error al obtener los documentos de la carpeta',
                'error',
                $e->getMessage()
            );
        }
    }
}
