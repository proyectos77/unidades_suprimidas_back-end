<?php

namespace App\Http\Controllers\DetalleUnidad;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleUnidad_request\registroDetalleUnidadRequest;
use App\Http\Requests\DetalleUnidad_request\updateDetalleUnidadRequest;
use App\Services\DetalleUnidad_services\actualizarDetalleUnidadServices;
use App\Services\DetalleUnidad_services\gestionDetalleUnidadServices;
use App\Services\DetalleUnidad_services\registroDetalleUnidadServices;
use Illuminate\Http\Request;

class DetalleUnidadController extends Controller
{

    protected $registroDetalle;
    protected $updateDetalle;

    public function __construct(registroDetalleUnidadServices $registroDetalle, actualizarDetalleUnidadServices $updateDetalle) {
        $this->registroDetalle = $registroDetalle;
        $this->updateDetalle = $updateDetalle;
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


}
