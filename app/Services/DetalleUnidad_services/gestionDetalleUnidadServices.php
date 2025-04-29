<?php


    namespace App\Services\DetalleUnidad_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;
use App\Models\DetalleUnidad\DetalleUnidadModel;
use Illuminate\Support\Facades\DB;

    class gestionDetalleUnidadServices
    {
        public function gestionRegistroDetalleUnidad($request) {

            DB::beginTransaction();

            try {

                $detalle = $this->registroDetalleUnidad($request);

                $archivo = $this->registroArchivos($request, $detalle['id_detalle']);

                DB::commit();


                $data= [
                    'detalle' => $detalle,
                    'archivo' => $archivo
                ];

                return Responses::success(200, 'Registro realizado', 'Se realizo el registro del detalle de la unidad', 'success', $data);

            } catch (\Exception $e) {
                DB::rollBack();
                return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', $e->getMessage());
            }
        }

        private function registroDetalleUnidad($request){

                $registroDetalle = DetalleUnidadModel::create([
                                                        'acto_administrativo_creacion_detalle'          => $request->input('acto_administrativo_creacion_detalle'),
                                                        'acto_administrativo_desactivacion_detalle'     =>  $request->input('acto_administrativo_desactivacion_detalle'),
                                                        'fecha_creacion_unidad_detalle'                 =>  $request->input('fecha_creacion_unidad_detalle'),
                                                        'fecha_desactivacion_unidad_detalle'            =>  $request->input('fecha_desactivacion_unidad_detalle'),
                                                        'puesto_mando_adelantado_detalle'               =>  $request->input('puesto_mando_adelantado_detalle'),
                                                        'puesto_mando_atrasado_detalle'                 =>  $request->input('puesto_mando_atrasado_detalle'),
                                                        'observacion_detalle'                           =>  $request->input('observacion_detalle'),
                                                        'id_unidad'                                     =>  $request->input('id_unidad'),
                                                    ]);

                if (!$registroDetalle) {
                    throw new \Exception("No se pudo crear el detalle de unidad");
                }
                return $registroDetalle;
        }

        private function registroArchivos($request, $idDetalle){
            $registroArchivo = ArchivoModel::create([
                                                'numero_cajas_archivos'     => $request->input('numero_cajas_archivos'),
                                                'numero_carpetas_archivo'   => $request->input('numero_carpetas_archivo'),
                                                'numero_folios_archivo'     => $request->input('numero_folios_archivo'),
                                                'id_detalle'                => $idDetalle,
                                            ]);

            if (!$registroArchivo) {
                throw new \Exception("No se pudo crear el archivo");
            }

            return $registroArchivo;
        }
    }
