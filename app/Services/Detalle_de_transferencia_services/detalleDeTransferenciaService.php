<?php

    namespace App\Services\Detalle_de_transferencia_services;

use App\Models\Archivo\ArchivoModel;
use App\Models\DetalleTransferencia\DetalleTransferenciaModel;

    class detalleDeTransferenciaService
    {
        public function registroDetalleTransferencia($data, $transferencia){
                // Se valida el archivo y se obtiene el modelo para evitar una segunda consulta a la BD.


                $archivo = $this->validarArchivo($transferencia->id_archivo);

                foreach ($data as $value) {

                    $data['porcentaje_detalle_transferencia'] =  $this->calcularPorcentaje($transferencia->id_transferencia, $archivo, $value
                    ['cantidad_cajas'], $value['cantidad_carpetas'], $value['cantidad_folios'],
                    $value['cantidad_otros'], $value['cantidad_tomos']);

                    /* var_dump($data['porcentaje_detalle_transferencia']);die(); */
                    $data['id_transferencia'] = $transferencia->id_transferencia;

                    $registro = DetalleTransferenciaModel::create([
                        'id_transferencia'                     => $transferencia->id_transferencia ?? null,
                        'seccion_detalle_transferencia'        => $value['seccion'] ?? null,
                        'serie_detalle_transferencia'          => $value['serie'] ?? null,
                        'subserie_detalle_transferencia'       => $value['subserie'] ?? null,
                        'cantidad_cajas_detalle_transferencia' => $value['cantidad_cajas'] ?? 0,
                        'cantidad_carpetas_detalle_transferencia' => $value['cantidad_carpetas'] ?? 0,
                        'cantidad_folios_detalle_transferencia' => $value['cantidad_folios'] ?? 0,
                        'cantidad_otros_detalle_transferencia' => $value['cantidad_otros'] ?? 0,
                        'cantidad_tomos_detalle_transferencia' => $value['cantidad_tomos'] ?? 0,
                        'porcentaje_detalle_transferencia'     => $data['porcentaje_detalle_transferencia'] ?? 0,
                    ]);

                    if(!$registro){
                        throw new \Exception('No se puedo realizar el registro.');
                    }


                }

                return $registro;
                // Se pasa el objeto $archivo completo a la función para que tenga todo el contexto.


        }

        private function validarArchivo($idArchivo){
            $archivo = ArchivoModel::find($idArchivo);

            if($archivo == null){
                throw new \Exception('El archivo no existe.');
            }

            return $archivo;
        }

        private function calcularPorcentaje($idTransferencia, $cantidades, $cantidadCajasTransferencia, $cantidadCarpetas, $cantidadFolios, $cantidadOtros, $cantidadTomos){
            // 1. Validar Cajas y calcular porcentaje, manejando la división por cero.
            $solicitudes = DetalleTransferenciaModel::where('id_transferencia', $idTransferencia)->get();

            $totalCajas = $solicitudes->sum('cantidad_cajas_transferencia');
            $totalCarpetas = $solicitudes->sum('cantidad_carpetas_transferencia');
            $totalFolios = $solicitudes->sum('cantidad_folios_transferencia');
            $totalOtros = $solicitudes->sum('cantidad_otros_transferencia');
            $totalTomos = $solicitudes->sum('cantidad_tomos_transferencia');

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

            // 5. Validar Tomos (solo si ambos valores existen)
            if (!is_null($cantidades->numero_tomos_archivo) && !is_null($cantidadTomos) && ($cantidadTomos + $totalTomos) > $cantidades->numero_tomos_archivo) {
                throw new \Exception("La cantidad de 'tomos' ({$cantidadTomos}) sumadas a las solicitudes de transferencias y transferencias aprobadas supera el límite del archivo registrado de 'tomos' ({$cantidades->numero_tomos_archivo}).");
            }

            return round($porcentajeTotal, 2);
        }
    }
