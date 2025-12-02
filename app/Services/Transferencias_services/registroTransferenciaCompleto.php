<?php

    namespace App\Services\Transferencias_services;

use App\Http\Responses\Responses;
use App\Services\Detalle_de_transferencia_services\detalleDeTransferenciaService;
use App\Services\Documentos_services\registroDocumentosService;
use App\Services\DocumentosTransferencias_services\documentosTransferencias;
use App\Services\SolicitudTransferencia\registroSolicitudTransferencia;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;

    class registroTransferenciaCompleto{

        private $registroTransferencia;
        private $registroDocumentos;
        private $registroDocumentosTransferencia;
        private $registroSolicitudTransferencia;
        private $registroDetalleTransferencia;

        public function __construct(
            registroTransferencia $registroTransferencia,
            registroDocumentosService $registroDocumentos,
            documentosTransferencias $registroDocumentosTransferencia,
            registroSolicitudTransferencia $registroSolicitudTransferencia,
            detalleDeTransferenciaService $registroDetalleTransferencia) {

            $this->registroTransferencia = $registroTransferencia;
            $this->registroDocumentos = $registroDocumentos;
            $this->registroDocumentosTransferencia = $registroDocumentosTransferencia;
            $this->registroSolicitudTransferencia = $registroSolicitudTransferencia;
            $this->registroDetalleTransferencia = $registroDetalleTransferencia;
        }

        public function registroSolicitudTransferencia($data, $usuario){
            DB::beginTransaction();
            $dataTransferencia = json_decode($data->transferencia, true);
            $detalleTransferecia = $data->detalles;


            try {
                $transferencia = $this->registroTransferencia->registroTransferencia($dataTransferencia);
                $detalleTransferencia = $this->registroDetalleTransferencia->registroDetalleTransferencia($detalleTransferecia, $transferencia);
                $documentos = $this->registroDocumentos->gestionRegistro($data->documentos);

                $this->registroDocumentosTransferencia->registroDocumentoTransferencia($transferencia, $documentos);
                $this->registroSolicitudTransferencia->registroSolicitud($data->transferencia, $usuario, $transferencia);
                DB::commit();

                return Responses::success(200, 'Registro', 'Registro de transferencia exitoso', 'success', $documentos);
            } catch (HttpException $e) {
                DB::rollBack();
                return Responses::warning(
                    $e->getStatusCode(),  // <- Este sí devuelve 422
                    'Cuidado',
                    $e->getMessage(),
                    $e->getMessage()
                );
            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(
                    500,
                    'Error',
                    $e->getMessage(),
                    $e->getMessage()
                );
            }

        }

    }

