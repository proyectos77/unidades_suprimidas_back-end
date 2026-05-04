<?php

namespace App\Services\CajaUnidadActiva_services;

use App\Http\Resources\CajaUnidadActiva\CajaUnidadActivaResource;
use App\Http\Responses\Responses;
use App\Models\CajaUnidadActiva\CajaUnidadActivaModel;

class registroCajaUnidadActivaServices
{
    public function registroCajaUnidadActiva($datos)
    {
        try {
            $cajas = $datos['cajas'] ?? [];
            $cajasCreadas = [];

            foreach ($cajas as $cajaData) {
                $cajaTransformada = [
                    'id_archivo_unidad_activa'                      => $cajaData['archivoUnidadActiva'] ?? null,
                    'id_balda'                                      => $cajaData['baldas'] ?? null,
                    'codigo_caja_unidad_activa'                     => $cajaData['codigoCaja'] ?? null,
                    'numero_consecutivo_bodega_unidad_activa'       => $cajaData['numeroConsecutivoBodega'] ?? null,
                    'numero_correlativo_dependencia_unidad_activa'  => $cajaData['numeroCorrelativoDependencia'] ?? null,
                    'anio_caja_unidad_activa'                       => $cajaData['anio'] ?? null,
                    'cantidad_libros_unidad_activa'                 => $cajaData['libros'] ?? null,
                    'cantidad_carpetas_unidad_activa'               => $cajaData['carpetas'] ?? null,
                ];

                $cajaUnidadActiva = CajaUnidadActivaModel::create($cajaTransformada);
                $cajasCreadas[] = new CajaUnidadActivaResource($cajaUnidadActiva);
            }

            $mensaje = count($cajasCreadas) === 1 ? 'caja' : 'cajas';

            return Responses::success(
                201,
                count($cajasCreadas) . ' ' . $mensaje . ' de unidad activa creadas',
                'Las cajas de unidad activa se han registrado exitosamente',
                'success',
                $cajasCreadas
            );

        } catch (\Illuminate\Database\QueryException $e) {
            /* \Log::error('Error de base de datos en registroCajaUnidadActiva: ' . $e->getMessage()); */
            return Responses::error(
                500,
                'Error de base de datos',
                'Error al registrar las cajas: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            /* \Log::error('Error general en registroCajaUnidadActiva: ' . $e->getMessage()); */
            return Responses::error(
                500,
                'Error al crear cajas de unidad activa',
                'No se pudieron registrar las cajas de unidad activa: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        }
    }

    public function listadoCajaUnidadActiva()
    {
        try {
            $cajas = CajaUnidadActivaModel::all();

            return Responses::success(
                200,
                'Listado de cajas',
                'Se obtuvo la lista de cajas de unidades activas',
                'success',
                CajaUnidadActivaResource::collection($cajas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener listado de cajas',
                'Error al obtener la lista de cajas de unidades activas',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerCajaUnidadActiva($id)
    {
        try {
            $cajaUnidadActiva = CajaUnidadActivaModel::findOrFail($id);

            return Responses::success(
                200,
                'Caja de unidad activa obtenida',
                'Se obtuvo la caja de unidad activa',
                'success',
                new CajaUnidadActivaResource($cajaUnidadActiva)
            );

        } catch (\Exception $e) {
            return Responses::error(
                404,
                'Caja no encontrada',
                'La caja de unidad activa no existe',
                'error',
                $e->getMessage()
            );
        }
    }

    public function actualizarCajaUnidadActiva($id, $datos)
    {
        try {
            $cajaUnidadActiva = CajaUnidadActivaModel::findOrFail($id);
            $cajaUnidadActiva->update($datos);

            return Responses::success(
                200,
                'Caja de unidad activa actualizada',
                'La caja de unidad activa se ha actualizado exitosamente',
                'success',
                new CajaUnidadActivaResource($cajaUnidadActiva)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al actualizar caja de unidad activa',
                'No se pudo actualizar la caja de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function eliminarCajaUnidadActiva($id)
    {
        try {
            $cajaUnidadActiva = CajaUnidadActivaModel::findOrFail($id);
            $cajaUnidadActiva->delete();

            return Responses::success(
                200,
                'Caja de unidad activa eliminada',
                'La caja de unidad activa se ha eliminado exitosamente',
                'success',
                null
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al eliminar caja de unidad activa',
                'No se pudo eliminar la caja de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCajasPorBalda($idBalda)
    {
        try {
            $cajas = CajaUnidadActivaModel::where('id_balda', $idBalda)->get();

            return Responses::success(
                200,
                'Listado de cajas por balda',
                'Se obtuvo la lista de cajas de la balda',
                'success',
                CajaUnidadActivaResource::collection($cajas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener cajas por balda',
                'Error al obtener las cajas de la balda',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCajasPorCuerpo($idCuerpo)
    {
        try {
            $cajas = CajaUnidadActivaModel::whereHas('balda.estante', function ($query) use ($idCuerpo) {
                $query->where('id_cuerpo', $idCuerpo);
            })->get();

            return Responses::success(
                200,
                'Listado de cajas por cuerpo',
                'Se obtuvo la lista de cajas del cuerpo',
                'success',
                CajaUnidadActivaResource::collection($cajas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener cajas por cuerpo',
                'Error al obtener las cajas del cuerpo',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCajasPorIdArchivoUnidadActiva($idArchivoUnidadActiva)
    {
        try {
            $cajas = CajaUnidadActivaModel::where('id_archivo_unidad_activa', $idArchivoUnidadActiva)->get();

            return Responses::success(
                200,
                'Listado de cajas',
                'Se obtuvo la lista de cajas del archivo de unidad activa',
                'success',
                CajaUnidadActivaResource::collection($cajas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener cajas',
                'Error al obtener las cajas del archivo de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }
}
