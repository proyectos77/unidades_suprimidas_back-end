<?php

    namespace App\Http\Resources\Documento;

use App\Models\Documentos\DocumentosModel;
use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;

    class informacionDocumentoService
    {
        public function verDocumento($idDocumento){
            $documento = DocumentosModel::find($idDocumento);
            return $documento;
        }
    }
