<?php

    namespace App\Services\Documentos_services;

use App\Models\Documentos\DocumentosModel;

    class registroDocumentosService
    {
        public function gestionRegistro($data){

            $documentos = [];

            for ($i=0; $i < count($data); $i++) {
               $documento = $this->registroDocumento($data[$i]);
               array_push($documentos, $documento);
            }

            return $documentos;
        }

        private function registroDocumento($data){


            $carpetaDestino = "documents";
            $nombreArchivo = pathinfo($data->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $data->getClientOriginalExtension();

            $nombrePersonalizado = $nombreArchivo . '.' . $extension;

            $ruta = $data->storeAs($carpetaDestino, $nombrePersonalizado, 'public');

            $documento = DocumentosModel::create(
                ['nombre_documento' => $data->getClientOriginalName(),
                'url_documento' => $ruta,
                'extension_documento' => $data->getClientOriginalExtension(),]
            );

            if(!$documento){
                throw new \Exception('No se puedo realizar el registro del documento.');
            }

            return $documento;
        }
    }
