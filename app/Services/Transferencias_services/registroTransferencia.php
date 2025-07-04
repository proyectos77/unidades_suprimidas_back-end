<?php

    namespace App\Services\Transferencias_services;
    use App\Http\Responses\Responses;
    use App\Models\Archivo\ArchivoModel;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;
use App\Models\Transferencias\TransferenciasModel;

    class registroTransferencia
    {
        public function registroTransferencia($data){
                // Se valida el archivo y se obtiene el modelo para evitar una segunda consulta a la BD.
                $archivo = $this->validarArchivo($data->id_archivo);

                // Se pasa el objeto $archivo completo a la función para que tenga todo el contexto.
                $data['porcentaje_transferencia'] =  $this->calcularPorcentaje($data->id_archivo, $archivo, $data->cantidad_cajas, $data->cantidad_carpetas, $data->cantidad_folios,
                $data->cantidad_otros);

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

        private function calcularPorcentaje($archivo, $cantidades, $cantidadCajasTransferencia, $cantidadCarpetas, $cantidadFolios, $cantidadOtros){
            // 1. Validar Cajas y calcular porcentaje, manejando la división por cero.

            $solicitudes = TransferenciasModel::where('id_archivo', $archivo)->get();

            $totalCajas = $solicitudes->sum('cantidad_cajas_transferencia');
            $totalCarpetas = $solicitudes->sum('cantidad_carpetas_transferencia');
            $totalFolios = $solicitudes->sum('cantidad_folios_transferencia');
            $totalOtros = $solicitudes->sum('cantidad_otros_transferencia');

             $sumaTransferida = $cantidadCajasTransferencia + $cantidadCarpetas + $cantidadFolios + $cantidadOtros;

             $totalDisponible = $cantidades->numero_cajas_archivos + $cantidades->numero_carpetas_archivo + $cantidades->numero_folios_archivo + ($cantidades->numero_otros_archivo ?? 0);

             $porcentajeTotal = ($sumaTransferida / $totalDisponible) * 100;

            /* $porcentaje = ($cantidadCajasTransferencia / $cantidades->numero_cajas_archivos) * 100; */
            if (($cantidadCajasTransferencia + $totalCajas ) > $cantidades->numero_cajas_archivos) {
                throw new \Exception("La cantidad de cajas ({$cantidadCajasTransferencia}) sumadas a las solicitudes de transferencias y transferencias aprobadas supera el límite del archivo registrado de cajas ({$cantidades->numero_cajas_archivos}).");
            }

            // 2. Validar Carpetas
            if (($cantidadCarpetas + $totalCarpetas) > $cantidades->numero_carpetas_archivo) {
                throw new \Exception("La cantidad de carpetas ({$cantidadCarpetas}) sumadas a las solicitudes de transferencias y transferencias aprobadas supera el límite del archivo registrado de carpetas ({$cantidades->numero_carpetas_archivo}).");
            }

            // 3. Validar Folios
            if (($cantidadFolios + $totalFolios) > $cantidades->numero_folios_archivo) {
                throw new \Exception("La cantidad de folios ({$cantidadFolios}) sumadas a las solicitudes de transferencias y transferencias aprobadas supera el límite del archivo registrado de folios ({$cantidades->numero_folios_archivo}).");
            }

            // 4. Validar Otros (solo si ambos valores existen)
            if (!is_null($cantidades->numero_otros_archivo) && !is_null($cantidadOtros) && ($cantidadOtros + $totalOtros) > $cantidades->numero_otros_archivo) {
                throw new \Exception("La cantidad de 'otros' ({$cantidadOtros}) sumadas a las solicitudes de transferencias y transferencias aprobadas supera el límite del archivo registrado de 'otros' ({$cantidades->numero_otros_archivo}).");
            }

            return round($porcentajeTotal, 2);
        }
    }
