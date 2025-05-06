<?php

namespace App\Services\Unidades_services;

use App\Http\Resources\Unidades\getInformacionUnidadResource;
use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class getInformacionUnidad
{
    public function informacionUnidad($id)
    {
        try {
            $informacion = UnidadesModel::with(["detalleUnidad.archivo", "municipio.departamentos"])->find($id);
            $respuesta = $this->validarData($informacion);
            return $respuesta;
        } catch (\Exception $e) {
            return Responses::error(500, 'Error consulta', 'Ha ocurrido un error interno', 'error', $e->getMessage());
        }
    }

    protected  function validarData($data){

        $respuesta='';

        if(!$data){
            $respuesta = Responses::error(404, 'Error consulta', 'No se encontró la unidad', []);
        }elseif(!$data->detalleUnidad){
            $respuesta = Responses::error(404, 'Unidad sin detalle', 'La unidad no tiene detalle asociado', []);
        }else{
            $respuesta = Responses::success(200, 'Consulta realizada', 'La consulta se ha realizado con exito', 'success', new getInformacionUnidadResource($data));
        }



        return $respuesta;
    }
}
