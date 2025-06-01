<?php

    namespace App\Services\Transferencias_services;

    use App\Http\Responses\Responses;
    use App\Services\Documentos_services\registroDocumentosService;
    use App\Services\DocumentosTransferencias_services\documentosTransferencias;
    use Illuminate\Support\Facades\DB;

    class registroTransferenciaCompleto{

        private $registroTransferencia;
        private $registroDocumentos;
        private $registroDocumentosTransferencia;

        public function __construct(
            registroTransferencia $registroTransferencia, registroDocumentosService $registroDocumentos, documentosTransferencias $registroDocumentosTransferencia) {
            $this->registroTransferencia = $registroTransferencia;
            $this->registroDocumentos = $registroDocumentos;
            $this->registroDocumentosTransferencia = $registroDocumentosTransferencia;
        }

        public function registroSolicitudTransferencia($data){

                DB::beginTransaction();

                try {
                    $transferencia = $this->registroTransferencia->registroTransferencia($data);
                    $documentos = $this->registroDocumentos->gestionRegistro($data->documentos);

                    $this->registroDocumentosTransferencia->registroDocumentoTransferencia($transferencia, $documentos);
                    DB::commit();

                    return Responses::success(200, 'Registro', 'Registro de transferencia exitoso', 'success', $documentos);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return Responses::error(500, 'Error', 'Error al realizar el registro', $e->getMessage());
                }

        }

    }

