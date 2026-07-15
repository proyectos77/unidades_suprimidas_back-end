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

    public function registroDocumentoGeneralFuid($request)
    {
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
            $documento->load('carpetaUnidadActiva');
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

    public function documentosPorCarpeta($idCarpeta)
    {
        try {
            $documentos = DocumentoGeneralFuidModel::with('carpetaUnidadActiva')
                ->where('id_carpeta_unidad_activa', $idCarpeta)
                ->get();

            return Responses::success(
                200,
                'Listado de documentos',
                'Se obtuvo la lista de documentos generales FUID de la carpeta',
                'success',
                registroDocumentoGeneralFuidResource::collection($documentos)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener documentos', 'Error al obtener los documentos de la carpeta', $e->getMessage());
        }
    }

    public function buscarDocumentos($filtros)
    {
        try {
            $query = DocumentoGeneralFuidModel::with('carpetaUnidadActiva');

            if (!empty($filtros['nombre_serie_subserie_asunto'])) {
                $query->where('nombre_serie_subserie_asunto', 'like', '%' . $filtros['nombre_serie_subserie_asunto'] . '%');
            }

            if (!empty($filtros['numero_orden'])) {
                $query->where('numero_orden', $filtros['numero_orden']);
            }

            if (!empty($filtros['codigo'])) {
                $query->where('codigo', $filtros['codigo']);
            }

            if (!empty($filtros['numero_caja'])) {
                $query->where('numero_caja', 'like', '%' . $filtros['numero_caja'] . '%');
            }

            if (!empty($filtros['numero_carpeta'])) {
                $query->where('numero_carpeta', 'like', '%' . $filtros['numero_carpeta'] . '%');
            }

            if (!empty($filtros['numero_tomo'])) {
                $query->where('numero_tomo', 'like', '%' . $filtros['numero_tomo'] . '%');
            }

            if (!empty($filtros['numero_soporte'])) {
                $query->where('numero_soporte', 'like', '%' . $filtros['numero_soporte'] . '%');
            }

            if (!empty($filtros['notas'])) {
                $query->where('notas', 'like', '%' . $filtros['notas'] . '%');
            }

            if (!empty($filtros['id_carpeta_unidad_activa'])) {
                $query->where('id_carpeta_unidad_activa', $filtros['id_carpeta_unidad_activa']);
            }

            if (!empty($filtros['fecha_extrema_inicio'])) {
                $query->whereDate('fecha_extrema_inicio', '>=', $filtros['fecha_extrema_inicio']);
            }

            if (!empty($filtros['fecha_extrema_fin'])) {
                $query->whereDate('fecha_extrema_fin', '<=', $filtros['fecha_extrema_fin']);
            }

            $documentos = $query->get();

            return Responses::success(
                200,
                'Resultados de búsqueda',
                'Se obtuvieron los documentos que coinciden con la búsqueda',
                'success',
                registroDocumentoGeneralFuidResource::collection($documentos)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error en la búsqueda', 'Ocurrió un error al buscar los documentos', $e->getMessage());
        }
    }

    public function subirArchivoExcel($request)
    {
        try {
            if (!$request->hasFile('archivo_excel')) {
                throw new HttpException(422, 'Debe adjuntar el archivo Excel a almacenar.');
            }

            $ruta = $this->almacenarDocumento($request->file('archivo_excel'));

            return Responses::success(200, 'Archivo almacenado', 'El archivo Excel se almacenó correctamente', 'success', ['url_documento' => $ruta]);
        } catch (HttpException $e) {
            return Responses::error($e->getStatusCode(), 'Error al almacenar el archivo', $e->getMessage(), null);
        } catch (\Exception $e) {
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
