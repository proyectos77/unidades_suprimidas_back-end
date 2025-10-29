<?php

    namespace App\Services\Unidades_services;

use App\Helpers\generalHelper;
use App\Http\Resources\Unidades\listadoUnidadesActivasResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

    class listadoUnidadesActivasService
    {
        public function getListadoUnidadesActivas($filtro = null, $idUnidadPadre = null)
        {
            try {

                $query = UnidadesModel::where('id_estado', 1)->with('padre');

                if ($filtro) {
                    $filtro = strtolower($filtro);
                    $query->where(function ($q) use ($filtro) {
                        $q->whereRaw('LOWER(nombre_unidad) LIKE ?', ["%{$filtro}%"])
                            ->orWhereRaw('LOWER(sigla_unidad) LIKE ?', ["%{$filtro}%"])
                            ->orWhereHas('padre', function ($q2) use ($filtro) {
                                $q2->whereRaw('LOWER(nombre_unidad) LIKE ?', ["%{$filtro}%"]);
                            });
                    });
                    $unidadesActivas = $query->get();
                    $dataPaginacion = null;
                }elseif ($idUnidadPadre) {
                    $unidadesActivas = UnidadesModel::where('padre_unidad', $idUnidadPadre)->where('id_estado', 1)->paginate(10);
                    $dataPaginacion = generalHelper::infoPagination(
                        $unidadesActivas->total(),
                        $unidadesActivas->perPage(),
                        $unidadesActivas->currentPage(),
                        $unidadesActivas->lastPage()
                    );
                }else {
                    $unidadesActivas = $query->paginate(10);
                    $dataPaginacion = generalHelper::infoPagination(
                        $unidadesActivas->total(),
                        $unidadesActivas->perPage(),
                        $unidadesActivas->currentPage(),
                        $unidadesActivas->lastPage()
                    );
                }
                $data = new listadoUnidadesActivasResource($unidadesActivas);


                return Responses::successListado(200, 'Consulta realizada', 'La consulta se ha realizado con exito', $data, $dataPaginacion);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }
        }
    }

