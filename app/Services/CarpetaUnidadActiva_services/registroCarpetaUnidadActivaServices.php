<?php

namespace App\Services\CarpetaUnidadActiva_services;

use App\Http\Resources\CarpetaUnidadActiva\CarpetaUnidadActivaResource;
use App\Http\Responses\Responses;
use App\Models\CarpetaUnidadActiva\CarpetaUnidadActivaModel;

class registroCarpetaUnidadActivaServices
{
    public function registroCarpetaUnidadActiva($datos)
    {
        try {
            $carpetas = $datos['carpetas'] ?? [];
            $carpetasCreadas = [];

            foreach ($carpetas as $carpetaData) {
                $carpetaTransformada = [
                    'id_caja_unidad_activa'                         => $carpetaData['cajaUnidadActiva'] ?? null,
                    'id_serie'                                      => $carpetaData['serie'] ?? null,
                    'id_subserie'                                   => $carpetaData['subserie'] ?? null,
                    'numero_carpeta_unidad_activa'                  => $carpetaData['numeroCarpeta'] ?? null,
                    'fecha_extrema_inicio'                          => $carpetaData['fechaExtremaInicio'] ?? null,
                    'fecha_extrema_fin'                             => $carpetaData['fechaExtremaFin'] ?? null,
                    'cantidad_folios'                               => $carpetaData['cantidadFolios'] ?? null,
                ];

                $carpetaUnidadActiva = CarpetaUnidadActivaModel::create($carpetaTransformada);
                $carpetasCreadas[] = new CarpetaUnidadActivaResource($carpetaUnidadActiva);
            }

            $mensaje = count($carpetasCreadas) === 1 ? 'carpeta' : 'carpetas';

            return Responses::success(
                201,
                count($carpetasCreadas) . ' ' . $mensaje . ' de unidad activa creadas',
                'Las carpetas de unidad activa se han registrado exitosamente',
                'success',
                $carpetasCreadas
            );

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Error de base de datos en registroCarpetaUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error de base de datos',
                'Error al registrar las carpetas: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            \Log::error('Error general en registroCarpetaUnidadActiva: ' . $e->getMessage());
            return Responses::error(
                500,
                'Error al crear carpetas de unidad activa',
                'No se pudieron registrar las carpetas de unidad activa: ' . $e->getMessage(),
                'error',
                $e->getMessage()
            );
        }
    }

    public function listadoCarpetaUnidadActiva()
    {
        try {
            $carpetas = CarpetaUnidadActivaModel::all();

            return Responses::success(
                200,
                'Listado de carpetas',
                'Se obtuvo la lista de carpetas de unidades activas',
                'success',
                CarpetaUnidadActivaResource::collection($carpetas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener listado de carpetas',
                'Error al obtener la lista de carpetas de unidades activas',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerCarpetaUnidadActiva($id)
    {
        try {
            $carpetaUnidadActiva = CarpetaUnidadActivaModel::findOrFail($id);

            return Responses::success(
                200,
                'Carpeta de unidad activa obtenida',
                'Se obtuvo la carpeta de unidad activa',
                'success',
                new CarpetaUnidadActivaResource($carpetaUnidadActiva)
            );

        } catch (\Exception $e) {
            return Responses::error(
                404,
                'Carpeta no encontrada',
                'La carpeta de unidad activa no existe',
                'error',
                $e->getMessage()
            );
        }
    }

    public function actualizarCarpetaUnidadActiva($id, $datos)
    {
        try {
            $carpetaUnidadActiva = CarpetaUnidadActivaModel::findOrFail($id);

            $carpetaTransformada = [
                'id_caja_unidad_activa'                         => $datos['cajaUnidadActiva'] ?? $carpetaUnidadActiva->id_caja_unidad_activa,
                'id_serie'                                      => $datos['serie'] ?? $carpetaUnidadActiva->id_serie,
                'id_subserie'                                   => $datos['subserie'] ?? $carpetaUnidadActiva->id_subserie,
                'numero_carpeta_unidad_activa'                  => $datos['numeroCarpeta'] ?? $carpetaUnidadActiva->numero_carpeta_unidad_activa,
                'fecha_extrema_inicio'                          => $datos['fechaExtremaInicio'] ?? $carpetaUnidadActiva->fecha_extrema_inicio,
                'fecha_extrema_fin'                             => $datos['fechaExtremaFin'] ?? $carpetaUnidadActiva->fecha_extrema_fin,
                'cantidad_folios'                               => $datos['cantidadFolios'] ?? $carpetaUnidadActiva->cantidad_folios,
            ];

            $carpetaUnidadActiva->update($carpetaTransformada);

            return Responses::success(
                200,
                'Carpeta de unidad activa actualizada',
                'La carpeta de unidad activa se ha actualizado exitosamente',
                'success',
                new CarpetaUnidadActivaResource($carpetaUnidadActiva)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al actualizar carpeta de unidad activa',
                'No se pudo actualizar la carpeta de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function eliminarCarpetaUnidadActiva($id)
    {
        try {
            $carpetaUnidadActiva = CarpetaUnidadActivaModel::findOrFail($id);
            $carpetaUnidadActiva->delete();

            return Responses::success(
                200,
                'Carpeta de unidad activa eliminada',
                'La carpeta de unidad activa se ha eliminado exitosamente',
                'success',
                null
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al eliminar carpeta de unidad activa',
                'No se pudo eliminar la carpeta de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCarpetasPorCaja($idCaja)
    {
        try {
            $carpetas = CarpetaUnidadActivaModel::where('id_caja_unidad_activa', $idCaja)->get();

            return Responses::success(
                200,
                'Listado de carpetas por caja',
                'Se obtuvo la lista de carpetas de la caja',
                'success',
                CarpetaUnidadActivaResource::collection($carpetas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener carpetas por caja',
                'Error al obtener las carpetas de la caja',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCarpetasPorSubserie($idSubserie)
    {
        try {
            $carpetas = CarpetaUnidadActivaModel::where('id_subserie', $idSubserie)->get();

            return Responses::success(
                200,
                'Listado de carpetas por subserie',
                'Se obtuvo la lista de carpetas de la subserie',
                'success',
                CarpetaUnidadActivaResource::collection($carpetas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener carpetas por subserie',
                'Error al obtener las carpetas de la subserie',
                'error',
                $e->getMessage()
            );
        }
    }

    public function getCarpetasPorIdArchivoUnidadActiva($idArchivoUnidadActiva)
    {
        try {
            $carpetas = CarpetaUnidadActivaModel::with(['cajaUnidadActiva.balda.estante.cuerpo'])
                ->whereHas('caja', function ($query) use ($idArchivoUnidadActiva) {
                    $query->where('id_archivo_unidad_activa', $idArchivoUnidadActiva);
                })->get();

            return Responses::success(
                200,
                'Listado de carpetas',
                'Se obtuvo la lista de carpetas del archivo de unidad activa',
                'success',
                CarpetaUnidadActivaResource::collection($carpetas)
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener carpetas',
                'Error al obtener las carpetas del archivo de unidad activa',
                'error',
                $e->getMessage()
            );
        }
    }
}
