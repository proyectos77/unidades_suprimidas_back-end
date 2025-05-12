<?php

    namespace App\Services\Transferencias_services;

use App\Http\Responses\Responses;
use Illuminate\Support\Facades\DB;

    class registroTransferenciaCompleto{

        private $registroTransferencia;
        private $registroDocumentos;
        private $registroDocumentosTransferencia;

        public function __construct(registroTransferencia $registroTransferencia) {
            $this->registroTransferencia = $registroTransferencia;
        }

        public function registroSolicitudTransferencia($data){

                DB::beginTransaction();

                try {
                    $data = $this->registroTransferencia->registroTransferencia($data);
                    DB::commit();



                    return Responses::success(200, 'Registro', 'Registro de transferencia exitoso', 'success', $data);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return Responses::error(500, 'Error', 'Error al realizar el registro', $e->getMessage());
                }

        }

    }

