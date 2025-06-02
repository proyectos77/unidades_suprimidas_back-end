<?php

    namespace App\Services\Transferencias_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;
use App\Models\Transferencias\TransferenciasModel;

    class registroTransferencia
    {
        public function registroTransferencia($data){


                $this->validarArchivo($data->id_archivo);

                $data['porcentaje_transferencia'] =  $this->calcularPorcentaje($data->id_archivo, $data->cantidad_cajas, $data->cantidad_carpetas, $data->cantidad_folios, $data->cantidad_tomos, $data->cantidad_otros);

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

        private function calcularPorcentaje($idArchivo, $cantidadCajasTransferencia, $cantidadCarpetas, $cantidadFolios, $cantidadTomos, $cantidadOtros){
            $cantidades = ArchivoModel::find($idArchivo);

            $porcentaje = ($cantidadCajasTransferencia / $cantidades->numero_cajas_archivos) * 100;

           if (
                $porcentaje > 100 ||
                $cantidadCarpetas > $cantidades->numero_carpetas_archivo ||
                $cantidadFolios > $cantidades->numero_folios_archivo ||
                (
                    !is_null($cantidades->numero_tomos_archivo) &&
                    !is_null($cantidadTomos) &&
                    $cantidadTomos > $cantidades->numero_tomos_archivo
                ) ||
                (
                    !is_null($cantidades->numero_otros_archivo) &&
                    !is_null($cantidadOtros) &&
                    $cantidadOtros > $cantidades->numero_otros_archivo
                )
            ) {
                throw new \Exception('Se superan las cantidades permitidas del archivo.');
            }


            return $porcentaje;
        }
    }
