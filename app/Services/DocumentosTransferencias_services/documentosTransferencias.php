<?php

    namespace App\Services\DocumentosTransferencias_services;

use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;

    class documentosTransferencias
    {
        public function registroDocumentoTransferencia($transferencia, $documentos) {

            foreach ($documentos as $documento) {
                $this->registro($transferencia->id_transferencia, $documento->id_documento);
            }

        }

        private function registro($idTransferencia, $idDocumento){
            $registro = DocumentoTransferenciaModel::create([
                'id_transferencia' => $idTransferencia,
                'id_documento' => $idDocumento,
            ]);

            if(!$registro){
                throw new \Exception('No se puedo realizar el registro del documento de transferencia.');
            }
            return $registro;
        }
    }
