<?php

namespace App\Services\Documentos_services;

use App\Http\Responses\Responses;
use App\Models\Documentos\DocumentosModel;
use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Storage;

class registroDocumentosService
{
    public function gestionRegistro($data, $op = null)
    {
        if ($op === 1) {
            $idTransferencia = $data->id_transferencia;
            $data = $data->allFiles();
        }

        if ($data instanceof \Illuminate\Http\UploadedFile) {
            $data = [$data];
        }

        if (is_array($data) && !array_is_list($data)) {
            $data = array_values($data);
        }

        $documentos = [];

        foreach ($data as $archivo) {
            $documentos[] = $this->registroDocumento($archivo, $op, $idTransferencia ?? null);
        }

        if ($op === 1) {
            return Responses::success(
                200,
                'Registro exitoso',
                'Documentos registrados con éxito',
                'success',
                $documentos
            );
        }

        return $documentos;
    }

    private function registroDocumento($data, $op, $idTransferencia = null)
    {
        $carpetaDestino = "documents";

        $nombreArchivo = pathinfo($data->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $data->getClientOriginalExtension();

        // 🔥 Validación de tamaño (10MB)
        $maxSize = 10 * 1024 * 1024;
        if ($data->getSize() > $maxSize) {
            throw new HttpException(422, 'El archivo supera el tamaño máximo permitido de 10 MB.');
        }

        $fechaHora = date('Ymd_His');
        $nombrePersonalizado = $nombreArchivo . '_' . $fechaHora . '.' . $extension;

        // 🔥 DISK CONFIGURADO
        $disk = config('filesystems.default');

        // 🔥 GUARDAR ARCHIVO
        $ruta = $data->storeAs(
            $carpetaDestino,
            $nombrePersonalizado,
            $disk
        );

        // 🔴 VALIDACIÓN CRÍTICA (esto reemplaza el dd)
        if (!$ruta) {
            throw new HttpException(500, 'Error al guardar el archivo en el servidor (verifique permisos de la carpeta).');
        }

        // 🔥 VALIDAR QUE REALMENTE EXISTE
        if (!Storage::disk($disk)->exists($ruta)) {
            throw new HttpException(500, 'El archivo no se pudo verificar después de guardarse.');
        }

        // 🔥 GUARDAR EN BD
        $documento = DocumentosModel::create([
            'nombre_documento' => $nombrePersonalizado,
            'url_documento' => $ruta,
            'extension_documento' => $extension,
        ]);

        if (!$documento) {
            throw new HttpException(422, 'No se pudo registrar el documento en la base de datos.');
        }

        // 🔥 RELACIÓN CON TRANSFERENCIA
        if ($op === 1) {
            DocumentoTransferenciaModel::create([
                'id_transferencia' => $idTransferencia,
                'id_documento' => $documento->id_documento,
            ]);
        }

        return $documento;
    }
}
