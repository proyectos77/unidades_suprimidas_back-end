<?php

namespace App\Services\Documentos_services;

use App\Http\Responses\Responses;
use App\Models\Documentos\DocumentosModel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class visualizarDocumentoService
{
    /**
     * Devuelve el contenido del documento para visualizarlo en línea,
     * sin exponer la ruta física del archivo al cliente.
     */
    public function visualizarDocumento($idDocumento)
    {
        try {
            $documento = DocumentosModel::where(['id_documento' => $idDocumento, 'id_estado' => 1])->first();

            if (!$documento || empty($documento->url_documento)) {
                throw new HttpException(404, 'Documento no encontrado.');
            }

            $disk = config('filesystems.default');

            if (!Storage::disk($disk)->exists($documento->url_documento)) {
                throw new HttpException(404, 'El archivo no se encuentra en el servidor.');
            }

            return Storage::disk($disk)->response($documento->url_documento, $documento->nombre_documento, [
                'Content-Disposition' => 'inline',
                'Cache-Control' => 'no-store, private',
            ]);
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al consultar', $e->getMessage(), 'error');
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al consultar', 'No se pudo abrir el documento', $e->getMessage());
        }
    }
}
