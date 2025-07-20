<?php

    namespace App\Services\Transferencias_services;
    use App\Http\Responses\Responses;
    use App\Models\Archivo\ArchivoModel;
    use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;
    use App\Models\Transferencias\TransferenciasModel;

    class registroTransferencia
    {
        public function registroTransferencia($data){
            $transferencia = TransferenciasModel::create([
                'id_archivo' => $data['id_archivo'],
                'fecha_creacion_transferencia' => now(),
                'fecha_actualizacion_transferencia' => now(),
                'id_estado' => 1, // Estado por defecto
            ]);

            return $transferencia;
        }
    }
