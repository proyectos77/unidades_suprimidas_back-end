<?php

    namespace App\Services\ArchivosUnidadActiva_services;

use App\Http\Responses\Responses;
use App\Models\ArchivoUnidadActiva\ArchivoUnidadActivaModel;
use Illuminate\Support\Facades\DB;

    class registroInformacionGeneralArchivoService
    {
        public function registroInformacionGeneralArchivoUnidadActiva($request) {

            try {
                    $archivoUnidadActiva = ArchivoUnidadActivaModel::create($request->all());

                    return Responses::success(200, 'Registro realizado', 'Se realizo el registro del archivo de la unidad activa', 'success', $archivoUnidadActiva);

                } catch (\Exception $e) {
                    return Responses::error(500, 'Error de registro', $e->getMessage(), $e->getMessage());
                }

        }

        public function obtenerTodosLosArchivos() {
            try {
                $archivos = ArchivoUnidadActivaModel::all();

                return Responses::success(200, 'Listado de archivos', 'Se obtuvo la lista de archivos de unidades activas', 'success', $archivos);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener archivos', 'No se pudo obtener el listado de archivos', 'error', $e->getMessage());
            }
        }

        public function obtenerArchivoPorIdUnidad($idUnidad) {
            try {
                $archivo = ArchivoUnidadActivaModel::where('id_unidad', $idUnidad)->firstOrFail();

                return Responses::success(200, 'Archivo obtenido', 'Se obtuvo la información del archivo', 'success', $archivo);

            } catch (\Exception $e) {
                return Responses::error(404, 'Archivo no encontrado', 'El archivo no existe', 'error', $e->getMessage());
            }
        }

        public function obtenerResumenAlmacenimientoUnidad($idUnidad) {
            try {
                $resultado = DB::select(
                    "select
                        u.nombre_unidad as unidad,
                        aua.ubicacion_archivo_unidad_activa as ubicacion,
                        aua.direccion_archivo_unidad_activa as direccion,
                        aua.edificio_archivo_unidad_activa as edificio,
                        aua.piso_archivo_unidad_activa as piso,
                        aua.bodega_archivo_unidad_activa as bodega,
                        COUNT(DISTINCT c.id_cuerpo) as cantidadCuerpos,
                        COUNT(DISTINCT est.id_estante) as cantidadEstante,
                        COUNT(DISTINCT bal.id_balda) as cantidadBaldas,
                        COUNT(DISTINCT cua2.id_caja_unidad_activa) as sumaCajas,
                        COUNT(DISTINCT cua.id_carpeta_unidad_activa) as sumaCarpetas,
                        SUM(DISTINCT cua.cantidad_folios) as sumaFolios
                    from carpetas_unidad_activas cua
                    inner join series s on s.id_serie = cua.id_serie
                    left join subseries s2 on s2.id_subserie = cua.id_subserie
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ?
                    group by u.nombre_unidad, aua.ubicacion_archivo_unidad_activa, aua.direccion_archivo_unidad_activa,
                             aua.edificio_archivo_unidad_activa, aua.piso_archivo_unidad_activa, aua.bodega_archivo_unidad_activa",
                    [$idUnidad]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Resumen de almacenamiento', 'No hay datos de almacenamiento para esta unidad', 'success', []);
                }

                return Responses::success(200, 'Resumen de almacenamiento', 'Se obtuvo el resumen de almacenamiento de la unidad', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener resumen', 'No se pudo obtener el resumen de almacenamiento', 'error', $e->getMessage());
            }
        }

        public function obtenerDetalleEstructuraUnidad($idUnidad) {
            try {
                $resultado = DB::select(
                    "select DISTINCT
                        c.id_cuerpo as id,
                        c.nombre_cuerpo as nombre
                    from carpetas_unidad_activas cua
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ?
                    order by c.id_cuerpo",
                    [$idUnidad]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Cuerpos de la unidad', 'No hay cuerpos para esta unidad', 'success', []);
                }

                return Responses::success(200, 'Cuerpos de la unidad', 'Se obtuvo la lista de cuerpos de la unidad', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener cuerpos', 'No se pudo obtener los cuerpos de la unidad', 'error', $e->getMessage());
            }
        }

        public function obtenerEstantesPorCuerpoUnidad($idUnidad, $idCuerpo) {
            try {
                $resultado = DB::select(
                    "select DISTINCT
                        est.nombre_estante as estante,
                        est.id_estante as idEstante
                    from carpetas_unidad_activas cua
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and c.id_cuerpo = ?
                    order by est.id_estante",
                    [$idUnidad, $idCuerpo]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Estantes del cuerpo', 'No hay estantes para este cuerpo en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Estantes del cuerpo', 'Se obtuvo la lista de estantes', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener estantes', 'No se pudo obtener los estantes', 'error', $e->getMessage());
            }
        }

        public function obtenerBaldasPorEstanteUnidad($idUnidad, $idEstante) {
            try {
                $resultado = DB::select(
                    "select DISTINCT
                        bal.nombre_balda as balda,
                        bal.id_balda as idBalda
                    from carpetas_unidad_activas cua
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and est.id_estante = ?
                    order by bal.id_balda",
                    [$idUnidad, $idEstante]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Baldas del estante', 'No hay baldas para este estante en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Baldas del estante', 'Se obtuvo la lista de baldas', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener baldas', 'No se pudo obtener las baldas', 'error', $e->getMessage());
            }
        }

        public function obtenerCajasPorBaldaUnidad($idUnidad, $idBalda) {
            try {
                $resultado = DB::select(
                    "select DISTINCT
                        cua2.id_caja_unidad_activa as id,
                        cua2.codigo_caja_unidad_activa as nombre,
                        c.nombre_cuerpo as nombreCuerpo,
                        est.nombre_estante as nombreEstante,
                        bal.nombre_balda as nombreBalda
                    from carpetas_unidad_activas cua
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and bal.id_balda = ?
                    order by cua2.id_caja_unidad_activa",
                    [$idUnidad, $idBalda]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Cajas de la balda', 'No hay cajas para esta balda en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Cajas de la balda', 'Se obtuvo la lista de cajas', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener cajas', 'No se pudo obtener las cajas', 'error', $e->getMessage());
            }
        }

        public function obtenerInfoCajaUnidad($idUnidad, $idCaja) {
            try {
                $resultado = DB::select(
                    "select
                        cua2.id_caja_unidad_activa as caja,
                        cua2.codigo_caja_unidad_activa as codigoCaja,
                        cua2.numero_consecutivo_bodega_unidad_activa as numeroConsecutivoBodega,
                        cua2.numero_correlativo_dependencia_unidad_activa as numeroCorrelativoDependencia,
                        cua2.anio_caja_unidad_activa as anioCaja,
                        cua2.cantidad_libros_unidad_activa as cantidadLibros,
                        COUNT(DISTINCT cua.id_carpeta_unidad_activa) as cantidadCarpetas,
                        c.nombre_cuerpo as nombreCuerpo,
                        est.nombre_estante as nombreEstante,
                        bal.nombre_balda as nombreBalda
                    from cajas_unidad_activas cua2
                    left join carpetas_unidad_activas cua on cua.id_caja_unidad_activa = cua2.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and cua2.id_caja_unidad_activa = ?
                    group by cua2.id_caja_unidad_activa, cua2.codigo_caja_unidad_activa, cua2.numero_consecutivo_bodega_unidad_activa,
                             cua2.numero_correlativo_dependencia_unidad_activa, cua2.anio_caja_unidad_activa, cua2.cantidad_libros_unidad_activa,
                             c.nombre_cuerpo, est.nombre_estante, bal.nombre_balda",
                    [$idUnidad, $idCaja]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Información de caja', 'La caja no existe en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Información de caja', 'Se obtuvo la información de la caja', 'success', $resultado[0]);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener información de caja', 'No se pudo obtener la información de la caja', 'error', $e->getMessage());
            }
        }

        public function obtenerCarpetasPorCajaUnidad($idUnidad, $idCaja) {
            try {
                $resultado = DB::select(
                    "select DISTINCT
                        cua.id_carpeta_unidad_activa as carpeta
                    from carpetas_unidad_activas cua
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and cua2.id_caja_unidad_activa = ?
                    order by cua.id_carpeta_unidad_activa",
                    [$idUnidad, $idCaja]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Carpetas de la caja', 'No hay carpetas para esta caja en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Carpetas de la caja', 'Se obtuvo la lista de carpetas', 'success', $resultado);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener carpetas', 'No se pudo obtener las carpetas', 'error', $e->getMessage());
            }
        }

        public function obtenerInfoCarpetaUnidad($idUnidad, $idCarpeta) {
            try {
                $resultado = DB::select(
                    "select
                        cua.id_carpeta_unidad_activa as carpeta,
                        s.nombre_serie as nombreSerie,
                        s2.nombre_subserie as nombreSubserie,
                        cua.numero_carpeta_unidad_activa as numeroCarpeta,
                        cua.fecha_extrema_inicio as fechaExtremaInicio,
                        cua.fecha_extrema_fin as fechaExtremaFin,
                        cua.cantidad_folios as cantidadFolios
                    from carpetas_unidad_activas cua
                    inner join series s on s.id_serie = cua.id_serie
                    left join subseries s2 on s2.id_subserie = cua.id_subserie
                    inner join cajas_unidad_activas cua2 on cua2.id_caja_unidad_activa = cua.id_caja_unidad_activa
                    inner join baldas bal on bal.id_balda = cua2.id_balda
                    inner join estantes est on est.id_estante = bal.id_estante
                    inner join cuerpos c on c.id_cuerpo = est.id_cuerpo
                    inner join archivo_unidades_activas aua on aua.id_archivo_unidad_activa = cua2.id_archivo_unidad_activa
                    inner join unidades u on u.id_unidad = aua.id_unidad
                    where u.id_unidad = ? and cua.id_carpeta_unidad_activa = ?",
                    [$idUnidad, $idCarpeta]
                );

                if (empty($resultado)) {
                    return Responses::success(200, 'Información de carpeta', 'La carpeta no existe en esta unidad', 'success', []);
                }

                return Responses::success(200, 'Información de carpeta', 'Se obtuvo la información de la carpeta', 'success', $resultado[0]);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener información de carpeta', 'No se pudo obtener la información de la carpeta', 'error', $e->getMessage());
            }
        }
    }
