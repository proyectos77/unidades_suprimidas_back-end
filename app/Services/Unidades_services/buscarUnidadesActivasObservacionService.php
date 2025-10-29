<?php

namespace App\Services\Unidades_services;

use App\Helpers\generalHelper;
use App\Http\Resources\Unidades\listadoUnidadesActivasResource;
use App\Http\Responses\Responses;
use App\Models\DetalleUnidad\DetalleUnidadModel;
use App\Models\Unidades\UnidadesModel;

class buscarUnidadesActivasObservacionService
{
    public function buscarUnidadActivaObservacion($observacion, $filtro = null)
    {
        try {
            $query = UnidadesModel::where('id_estado', 1)
                ->with([
                    'padre:id_unidad,nombre_unidad',
                    'estados:id_estado,nombre_estado',
                    'municipio.departamentos:id_departamento,nombre_departamento',
                    'detalleUnidad:id_detalle,observacion_detalle,id_unidad'
                ]);

            if ($observacion) {
                $observacion = strtolower($observacion);
                $query->whereHas('detalleUnidad', function ($q) use ($observacion) {
                    $q->whereRaw('LOWER(observacion_detalle) LIKE ?', ["%{$observacion}%"]);
                });

                $unidades = $query->get();
                $dataPaginacion = null;
            } else {
                $unidades = $query->paginate(10);
                $dataPaginacion = generalHelper::infoPagination(
                    $unidades->total(),
                    $unidades->perPage(),
                    $unidades->currentPage(),
                    $unidades->lastPage()
                );
            }

            $data = new listadoUnidadesActivasResource($unidades);

            return Responses::successListado( 200,'Consulta realizada','La consulta se ha realizado con éxito',$data,$dataPaginacion);

        } catch (\Exception $e) {
            return Responses::error(500,'Error consulta','Ocurrió un error al realizar la consulta.',$e->getMessage());
        }
    }
}
