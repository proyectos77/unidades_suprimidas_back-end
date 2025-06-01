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
        private $registroSolicitudTransferencia;
<<<<<<< HEAD

        public function __construct(
            registroTransferencia $registroTransferencia,
            registroDocumentosService $registroDocumentos,
            documentosTransferencias $registroDocumentosTransferencia,
            registroSolicitudTransferencia $registroSolicitudTransferencia) {

<<<<<<< HEAD
        public function __construct(
            registroTransferencia $registroTransferencia, registroDocumentosService $registroDocumentos, documentosTransferencias $registroDocumentosTransferencia) {
=======
>>>>>>> JMontero-Dev
=======

        public function __construct(
            registroTransferencia $registroTransferencia,
            registroDocumentosService $registroDocumentos,
            documentosTransferencias $registroDocumentosTransferencia,
            registroSolicitudTransferencia $registroSolicitudTransferencia) {

>>>>>>> JMontero-Dev
            $this->registroTransferencia = $registroTransferencia;
            $this->registroDocumentos = $registroDocumentos;
            $this->registroDocumentosTransferencia = $registroDocumentosTransferencia;
            $this->registroSolicitudTransferencia = $registroSolicitudTransferencia;
        }

        public function registroSolicitudTransferencia($data, $usuario){

            DB::beginTransaction();

            try {
                $transferencia = $this->registroTransferencia->registroTransferencia($data);
                $documentos = $this->registroDocumentos->gestionRegistro($data->documentos);

                $this->registroDocumentosTransferencia->registroDocumentoTransferencia($transferencia, $documentos);
                $this->registroSolicitudTransferencia->registroSolicitud($data, $usuario, $transferencia);
                DB::commit();

                return Responses::success(200, 'Registro', 'Registro de transferencia exitoso', 'success', $documentos);
            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(500, 'Error', 'Error al realizar el registro', $e->getMessage());
            }

<<<<<<< HEAD
<<<<<<< HEAD
                    return Responses::success(200, 'Registro', 'Registro de transferencia exitoso', 'success', $documentos);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return Responses::error(500, 'Error', 'Error al realizar el registro', $e->getMessage());
                }

=======
>>>>>>> JMontero-Dev
=======
>>>>>>> JMontero-Dev
        }

    }

