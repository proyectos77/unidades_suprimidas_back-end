<?php

namespace App\Services\DocumentoGeneralFuid_services;

use App\Http\Resources\DocumentoGeneralFuid\registroDocumentoGeneralFuidResource;
use App\Http\Responses\Responses;
use App\Models\DocumentoGeneralFuid\DocumentoGeneralFuidModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class registroDocumentoGeneralFuidService
{
    protected $carpetaDestino = 'documentosFUID';
    protected $maxSize = 10 * 1024 * 1024; // 10MB

    public function listarDocumentos(){
        try {
            $documentos = DocumentoGeneralFuidModel::with(['cajaUnidadActiva', 'estados'])->get();

            return Responses::success(200, 'Listado de documentos', 'Se obtuvo la lista de documentos generales FUID', 'success', registroDocumentoGeneralFuidResource::collection($documentos));
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener documentos', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function registroDocumentoGeneralFuid($request){
        DB::beginTransaction();
        try {
            $datos = $request->all();

            // Si hay archivo adjunto, procesarlo
            if ($request->hasFile('archivo_documento')) {
                $archivo = $request->file('archivo_documento');
                $datos['url_documento'] = $this->almacenarDocumento($archivo);
            } else if (empty($datos['url_documento'])) {
                // Si no hay archivo ni URL, asignar un valor por defecto
                $datos['url_documento'] = 'sin-documento';
            }

            $documento = DocumentoGeneralFuidModel::create($datos);
            $documento->load('cajaUnidadActiva');
            DB::commit();
            return Responses::success(200, 'Registro realizado', 'Se realizó el registro del documento general FUID correctamente', 'success', new registroDocumentoGeneralFuidResource($documento));
        } catch (HttpException $e) {
            DB::rollBack();
            return Responses::error($e->getStatusCode(), 'Error de validación', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            return Responses::error(500, 'Error de registros', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function obtenerDocumento($id){
        try {
            $documento = DocumentoGeneralFuidModel::with(['cajaUnidadActiva', 'estados', 'detalles.carpetaUnidadActiva'])->findOrFail($id);
            return Responses::success(200, 'Documento obtenido', 'Se obtuvo el documento general FUID correctamente', 'success', new registroDocumentoGeneralFuidResource($documento));
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener el documento', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function actualizarDocumento($id, $request){
        DB::beginTransaction();
        try {
            $documento = DocumentoGeneralFuidModel::findOrFail($id);
            $datos = $request->all();

            if ($request->hasFile('archivo_documento')) {
                $archivo = $request->file('archivo_documento');
                $datos['url_documento'] = $this->almacenarDocumento($archivo);
            }

            $documento->update($datos);
            $documento->load('cajaUnidadActiva');
            DB::commit();
            return Responses::success(200, 'Actualización realizada', 'Se actualizó el documento general FUID correctamente', 'success', new registroDocumentoGeneralFuidResource($documento));
        } catch (HttpException $e) {
            DB::rollBack();
            return Responses::error($e->getStatusCode(), 'Error de validación', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            return Responses::error(500, 'Error de actualización', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function eliminarDocumento($id){
        try {
            $documento = DocumentoGeneralFuidModel::findOrFail($id);
            $documento->delete();
            return Responses::success(200, 'Eliminación realizada', 'Se eliminó el documento general FUID correctamente', 'success', null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al eliminar', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function documentosPorCaja($idCaja){
        try {
            $documentos = DocumentoGeneralFuidModel::with('cajaUnidadActiva')
                ->where('id_caja_unidad_activa', $idCaja)
                ->get();

            return Responses::success(
                200,
                'Listado de documentos',
                'Se obtuvo la lista de documentos generales FUID de la caja',
                'success',
                registroDocumentoGeneralFuidResource::collection($documentos)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener documentos', 'Error al obtener los documentos de la caja', $e->getMessage());
        }
    }

    public function descargarDocumento($id){
        try {
            $documento = DocumentoGeneralFuidModel::findOrFail($id);

            if (empty($documento->url_documento) || $documento->url_documento === 'sin-documento') {
                throw new HttpException(404, 'Este documento no tiene un archivo asociado.');
            }

            $disk = config('filesystems.default');

            if (!Storage::disk($disk)->exists($documento->url_documento)) {
                throw new HttpException(404, 'El archivo no se encuentra en el servidor.');
            }

            return Storage::disk($disk)->download($documento->url_documento);
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al descargar', $e->getMessage(), null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al descargar', 'No se pudo descargar el documento', $e->getMessage());
        }
    }

    public function subirArchivoExcel($request){
        try {
            // Aceptar múltiples nombres de campos posibles
            $camposPosibles = ['archivo_excel', 'archivo_documento', 'archivo', 'file', 'excel'];
            $archivo = null;

            foreach ($camposPosibles as $campo) {
                if ($request->hasFile($campo)) {
                    $archivo = $request->file($campo);
                    break;
                }
            }

            if (!$archivo) {
                throw new HttpException(422, 'Debe adjuntar el archivo Excel a almacenar. Campos aceptados: archivo_excel, archivo_documento, archivo, file, excel');
            }

            $ruta = $this->almacenarDocumento($archivo);

            return Responses::success(200, 'Archivo almacenado', 'El archivo Excel se almacenó correctamente', 'success', ['url_documento' => $ruta]);
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al almacenar el archivo', $e->getMessage(), null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al almacenar el archivo', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function almacenarDocumento($archivo){
        // Validar tamaño del archivo
        if ($archivo->getSize() > $this->maxSize) {
            throw new HttpException(422, 'El archivo supera el tamaño máximo permitido de 10 MB.');
        }

        // Obtener nombre y extensión
        $nombreArchivo = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $archivo->getClientOriginalExtension();

        // Validar extensión permitida
        $extensionesPermitidas = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'txt'];
        if (!in_array(strtolower($extension), $extensionesPermitidas)) {
            throw new HttpException(422, 'El tipo de archivo no está permitido. Extensiones válidas: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, txt');
        }

        // Crear nombre personalizado con timestamp
        $fechaHora = date('Ymd_His');
        $nombrePersonalizado = $nombreArchivo . '_' . $fechaHora . '.' . $extension;

        // Obtener el disco configurado (public para local, bodega para producción)
        $disk = config('filesystems.default');

        // Guardar archivo
        $ruta = $archivo->storeAs(
            $this->carpetaDestino,
            $nombrePersonalizado,
            $disk
        );

        // Validación crítica
        if (!$ruta) {
            throw new HttpException(500, 'Error al guardar el archivo en el servidor (verifique permisos de la carpeta).');
        }

        // Verificar que el archivo existe
        if (!Storage::disk($disk)->exists($ruta)) {
            throw new HttpException(500, 'El archivo no se pudo verificar después de guardarse.');
        }

        return $ruta;
    }
}
