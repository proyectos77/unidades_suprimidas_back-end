<?php

    namespace App\Services\Transferencias_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;
use App\Models\Transferencias\TransferenciasModel;

    class registroTransferencia
    {
        public function registroTransferencia($data){


                $this->validarArchivo($data->id_archivo);

                $data['porcentaje_transferencia'] =  $this->calcularPorcentaje($data->id_archivo, $data->cantidad_cajas);

                $registro = TransferenciasModel::create($data->all());

                if(!$registro){
                    throw new \Exception('No se puedo realizar el registro.');
                }

                return $registro;

        }

        private function validarArchivo($idArchivo){

            $archivo = ArchivoModel::find($idArchivo);

            if($archivo == null){
                throw new \Exception('El archivo no existe.');
            }

            return $archivo;

        }

        private function calcularPorcentaje($idArchivo, $cantidadCajasTransferencia){
            $cantidadCajas = ArchivoModel::where('id_archivo', $idArchivo)->value('numero_cajas_archivos');

            return ($cantidadCajasTransferencia / $cantidadCajas) * 100;
        }
    }
