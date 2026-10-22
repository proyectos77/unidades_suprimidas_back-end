<?php

namespace App\Services\DocumentacionSistema;

use App\Http\Responses\Responses;
use App\Models\DocumentosSistema\DocumentosSistemasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class registroDocumentacionSistema
{
    protected $carpetaDestino = 'document/manuales';
    protected $maxSize = 10 * 1024 * 1024; // 10MB
    protected $extensionesPermitidas = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'txt', 'mp4'];

    public function registroDocumentacion($request)
    {
        DB::beginTransaction();
        try {
            $archivo = $request->file('archivo');
            $ruta = $this->almacenarDocumento($archivo);

            $documento = DocumentosSistemasModel::create([
                'nombre_documento_sistema'        => $request->nombre_documento_sistema,
                'descripcion_documento_sistema'    => $request->descripcion_documento_sistema ?? $request->nombre_documento_sistema ?? null,
                'id_tipo_documentacion_sistema'    => $request->id_tipo_documentacion_sistema,
                'ruta_documento_sistema'           => $ruta,
                'id_estado'                        => 1,
            ]);

            DB::commit();

            return Responses::success(200, 'Archivo almacenado', 'El archivo se almacenó correctamente', 'success', [
                'id_documento_sistema'   => $documento->id_documento_sistema,
                'ruta_documento_sistema' => $ruta,
            ]);
        } catch (HttpException $e) {
            DB::rollBack();
            return Responses::error($e->getStatusCode(), 'Error al almacenar el archivo', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            return Responses::error(500, 'Error al almacenar el archivo', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function almacenarDocumento($archivo)
    {
        // Validar tamaño del archivo
        if ($archivo->getSize() > $this->maxSize) {
            throw new HttpException(422, 'El archivo supera el tamaño máximo permitido de 10 MB.');
        }

        // Obtener nombre y extensión
        $nombreArchivo = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $archivo->getClientOriginalExtension();

        // Validar extensión permitida
        if (!in_array(strtolower($extension), $this->extensionesPermitidas)) {
            throw new HttpException(422, 'El tipo de archivo no está permitido. Extensiones válidas: ' . implode(', ', $this->extensionesPermitidas));
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
