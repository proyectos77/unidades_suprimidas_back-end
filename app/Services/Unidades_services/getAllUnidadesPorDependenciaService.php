<?php

    namespace App\Services\Unidades_services;

use App\Helpers\generalHelper;
use App\Http\Resources\Unidades\listadoUnidadesResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use App\Models\Usuarios\UsuariosModel;

    class getAllUnidadesPorDependenciaService
    {
        public function getAllUnidadesDependencia($idDependencia, $filtro = null)
        {
            try {
                // Buscar los usuarios que pertenecen a la dependencia
                $usuariosIds = UsuariosModel::where('id_dependencia', $idDependencia)->pluck('id_usuario');

                // Buscar las unidades que tienen esos usuarios
                $query = UnidadesModel::whereIn('id_usuario', $usuariosIds);

                if ($filtro) {
                    $filtro = strtolower($filtro);
                    $query->where(function ($q) use ($filtro) {
                        $q->whereRaw('LOWER(nombre_unidad) LIKE ?', ["%{$filtro}%"])
                            ->orWhereRaw('LOWER(sigla_unidad) LIKE ?', ["%{$filtro}%"])
                            ->orWhereRaw('LOWER(unidad_superior_jerarquicamente_unidad) LIKE ?', ["%{$filtro}%"])
                            ->orWhereRaw('LOWER(unidad_que_asume_archivo_unidad) LIKE ?', ["%{$filtro}%"]);
                    });

                    $unidades = $query->get();
                    $dataPaginacion = null;
                }else{

                    $unidades = $query->paginate(10);
                        $dataPaginacion = generalHelper::infoPagination($unidades->total(), $unidades->perPage(), $unidades->currentPage(), $unidades->lastPage());
                    if ($unidades->isEmpty()) {

                    }
                }

                if ($unidades->isEmpty()) {
                    return Responses::success(200, 'Sin resultados', 'No se encontraron unidades', 'success');
                }

                $data = new listadoUnidadesResource($unidades);


                return Responses::successListado(200, 'Consulta realizada', 'La consulta se ha realizado con exito', $data, $dataPaginacion);
            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }
        }
    }
