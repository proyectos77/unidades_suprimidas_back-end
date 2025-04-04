<?php

namespace App\Http\Controllers\DetalleUnidad;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleUnidad_request\registroDetalleUnidadRequest;
use App\Services\DetalleUnidad_services\registroDetalleUnidadServices;
use Illuminate\Http\Request;

class DetalleUnidadController extends Controller
{

    protected $registroDetalle;

    public function __construct(registroDetalleUnidadServices $registroDetalle) {
        $this->registroDetalle = $registroDetalle;
    }

    public function index(){

    }

    public function store(registroDetalleUnidadRequest $request){

        return $this->registroDetalle->registroDetalleUnidad($request);
    }

    public function show(string $id){
        //
    }

    public function update(Request $request, string $id){
        //
    }

    public function destroy(string $id){
        //
    }


}
