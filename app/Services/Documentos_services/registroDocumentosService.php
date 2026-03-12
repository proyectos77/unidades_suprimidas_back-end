<?php

    namespace App\Services\Documentos_services;

use App\Http\Responses\Responses;
use App\Models\Documentos\DocumentosModel;
use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;
use Symfony\Component\HttpKernel\Exception\HttpException;

    class registroDocumentosService
    {
        public function gestionRegistro($data, $op= null){

            if ($op === 1) {
                $idTransferencia = $data->id_transferencia;
                $data = $data->allFiles();

            }

            // Si es un solo archivo (UploadedFile), lo meto en un array
            if ($data instanceof \Illuminate\Http\UploadedFile) {
                $data = [$data];
            }

            // Si viene como array asociativo de archivos (ej: ["documento" => UploadedFile])
            if (is_array($data) && !array_is_list($data)) {
                $data = array_values($data); // reindexa el array a 0,1,2...
            }

            $documentos = [];

            foreach ($data as $archivo) {
                $documento = $this->registroDocumento($archivo, $op, $idTransferencia ?? null);
                $documentos[] = $documento;
            }

            if ($op === 1) {
                return Responses::success(200, 'Registro exitoso', 'Documentos registrados con éxito', 'success', $documentos);
            }else{
                return $documentos;
            }

        }

        private function registroDocumento($data, $op, $idTransferencia = null){
            $carpetaDestino = "documents";
            $nombreArchivo = pathinfo($data->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $data->getClientOriginalExtension();

            // Validación de tamaño máximo (10 MB)
            $maxSize = 10 * 1024 * 1024; // 10 MB en bytes
            if ($data->getSize() > $maxSize) {
                throw new HttpException(422, 'El archivo supera el tamaño máximo permitido de 10 MB.');
            }

            // Agregar fecha y hora al nombre del archivo
            $fechaHora = date('Ymd_His');
            $nombrePersonalizado = $nombreArchivo . '_' . $fechaHora . '.' . $extension;

            $ruta = $data->storeAs($carpetaDestino, $nombrePersonalizado, 'public');

            $documento = DocumentosModel::create(
                [
                    'nombre_documento' => $nombrePersonalizado,
                    'url_documento' => $ruta,
                    'extension_documento' => $extension,
                ]
            );

            if(!$documento){
                throw new HttpException(422,'No se puedo realizar el registro del documento.');
            }

            if ($op === 1) {
                DocumentoTransferenciaModel::create([
                    'id_transferencia' => $idTransferencia,
                    'id_documento' => $documento->id_documento,
                ]);
            }

            return $documento;
        }
    }
