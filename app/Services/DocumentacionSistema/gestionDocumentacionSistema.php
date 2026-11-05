<?php

namespace App\Services\DocumentacionSistema;

use App\Http\Responses\Responses;
use App\Models\DocumentosSistema\DocumentosSistemasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class gestionDocumentacionSistema
{
    protected $registroDocumentacionSistema;

    public function __construct(registroDocumentacionSistema $registroDocumentacionSistema)
    {
        $this->registroDocumentacionSistema = $registroDocumentacionSistema;
    }

    public function actualizarDocumentacion($request, $idDocumento)
    {
        DB::beginTransaction();
        $rutaNueva = null;
        try {
            $documento = DocumentosSistemasModel::find($idDocumento);
            if (!$documento) {
                throw new HttpException(404, 'Documento no encontrado.');
            }

            $rutaAnterior = $documento->ruta_documento_sistema;

            $documento->nombre_documento_sistema = $request->nombreDocumento;
            $documento->descripcion_documento_sistema = $request->nombreDocumento;
            $documento->id_tipo_documentacion_sistema = $request->tipoDocumento;

            if ($request->filled('estado')) {
                $documento->id_estado = $request->estado;
            }

            if ($request->hasFile('archivo')) {
                $rutaNueva = $this->registroDocumentacionSistema->almacenarDocumento($request->file('archivo'));
                $documento->ruta_documento_sistema = $rutaNueva;
            }

            $documento->save();
            DB::commit();

            // El archivo anterior solo se elimina cuando el registro quedó actualizado
            if ($rutaNueva && $rutaAnterior) {
                Storage::disk(config('filesystems.default'))->delete($rutaAnterior);
            }

            return Responses::success(200, 'Documento actualizado', 'La documentación se actualizó correctamente', 'success');
        } catch (HttpException $e) {
            DB::rollBack();
            $this->eliminarArchivoHuerfano($rutaNueva);
            return Responses::error($e->getStatusCode(), 'Error al actualizar', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->eliminarArchivoHuerfano($rutaNueva);
            return Responses::error(500, 'Error al actualizar', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    /**
     * Inactiva el documento (no se borra el archivo para poder reactivarlo desde la edición).
     */
    public function inactivarDocumentacion($idDocumento)
    {
        try {
            $documento = DocumentosSistemasModel::find($idDocumento);
            if (!$documento) {
                throw new HttpException(404, 'Documento no encontrado.');
            }

            $documento->update(['id_estado' => 2]);

            return Responses::success(200, 'Documento inactivado', 'La documentación se inactivó correctamente', 'success');
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al inactivar', $e->getMessage(), null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al inactivar', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    /**
     * Devuelve el archivo para visualizarlo en línea sin exponer su ruta física.
     */
    public function visualizarDocumentacion($idDocumento)
    {
        try {
            $documento = DocumentosSistemasModel::find($idDocumento);
            if (!$documento || empty($documento->ruta_documento_sistema)) {
                throw new HttpException(404, 'Documento no encontrado.');
            }

            $disk = config('filesystems.default');

            if (!Storage::disk($disk)->exists($documento->ruta_documento_sistema)) {
                throw new HttpException(404, 'El archivo no se encuentra en el servidor.');
            }

            return Storage::disk($disk)->response($documento->ruta_documento_sistema, basename($documento->ruta_documento_sistema), [
                'Content-Disposition' => 'inline',
                'Cache-Control' => 'no-store, private',
            ]);
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al consultar', $e->getMessage(), null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al consultar', 'No se pudo abrir el documento', $e->getMessage());
        }
    }

    private function eliminarArchivoHuerfano($ruta)
    {
        if ($ruta) {
            Storage::disk(config('filesystems.default'))->delete($ruta);
        }
    }
}
