<?php

    namespace App\Services\Archivo_services;

use App\Http\Responses\Responses;
use App\Models\ArchivoUnidadActiva\ArchivoUnidadActivaModel;
use Illuminate\Support\Facades\DB;

    class registroArchivoUnidadesActivasServices
    {
        public function registroArchivoUnidadesActivas($request)  {
            try {
            DB::beginTransaction();

            foreach ($request->all() as $value) {
                $unidadActiva = ArchivoUnidadActivaModel::create([
                    'anio_registro_archivo_unidad_activa'     => $value['anioRegistro'],
                    'seccion_archivo_unidad_activa'           => $value['seccion'],
                    'id_serie'                                => $value['serie'],
                    'id_subserie'                             => $value['subserie'],
                    'cantidad_cajas_archivo_unidad_activa'    => $value['cajas'],
                    'cantidad_carpetas_archivo_unidad_activa' => $value['carpetas'],
                    'cantidad_tomos_archivo_unidad_activa'    => $value['tomos'] ?? null,
                    'cantidad_folios_archivo_unidad_activa'   => $value['folios'],
                    'cantidad_otros_archivo_unidad_activa'    => $value['otros'] ?? null,
                    'descripcion_otro_archivo_unidad_activa'  => $value['descripcionOtro'] ?? null,
                    'id_unidad'                               => $value['idUnidad'],
                    'fecha_creacion_archivo_unidad_activa'    => now(),
                    'fecha_actualizacion_archivo_unidad_activa' => now(),
                ]);
            }

            DB::commit();

            return Responses::success(200, 'Registro realizado', 'Se realizó el registro del archivo de la unidad activa', 'success', $unidadActiva);

        } catch (\Exception $e) {
            DB::rollBack();
            return Responses::error(500, 'Error en el registro', 'No se pudo realizar el registro del archivo de la unidad activa', $e->getMessage());
        }
        }
    }
