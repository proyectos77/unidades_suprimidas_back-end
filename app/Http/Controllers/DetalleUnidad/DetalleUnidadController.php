<?php

namespace App\Http\Controllers\DetalleUnidad;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleUnidad_request\registroDetalleUnidadRequest;
use App\Http\Requests\DetalleUnidad_request\updateDetalleUnidadRequest;
use App\Services\DetalleUnidad_services\actualizarDetalleUnidadServices;
use App\Services\DetalleUnidad_services\gestionDetalleUnidadServices;
use App\Services\DetalleUnidad_services\registroDetalleUnidadServices;
use App\Services\Unidades_services\buscarUnidadesActivasObservacionService;
use App\Services\Unidades_services\buscarUnidadesObservacionService;
use Illuminate\Http\Request;

class detalleUnidadController extends Controller
{

    protected $registroDetalle;
    protected $updateDetalle;
    protected $buscarPorObservacion;
    protected $busquedaUnidadActivaObservacion;

    public function __construct(
        registroDetalleUnidadServices $registroDetalle,
        actualizarDetalleUnidadServices $updateDetalle,
        buscarUnidadesObservacionService $buscarPorObservacion,
        buscarUnidadesActivasObservacionService $busquedaUnidadActivaObservacion
    ) {
        $this->registroDetalle = $registroDetalle;
        $this->updateDetalle = $updateDetalle;
        $this->buscarPorObservacion = $buscarPorObservacion;
        $this->busquedaUnidadActivaObservacion = $busquedaUnidadActivaObservacion;
    }

    public function index(){

    }

    public function store(registroDetalleUnidadRequest $request){

        return $this->registroDetalle->registroDetalleUnidad($request);
    }

    public function show(string $id){

    }

    public function update(updateDetalleUnidadRequest $request, string $id){
        return $this->updateDetalle->actualizarDetalle($request, $id);
    }

    public function destroy(string $id){
        //
    }

    public function buscarObservacion(string $observacion, string $idDependencia){
        return $this->buscarPorObservacion->buscarObservacion(trim($observacion), $idDependencia);
    }

    public function buscarObservacionUnidadActiva(string $observacion){
        return $this->busquedaUnidadActivaObservacion->buscarUnidadActivaObservacion($observacion);
    }


}
