<?php

namespace App\Http\Controllers\Unidades;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidades_request\actualizarUnidadRequest;
use App\Http\Requests\Unidades_request\registroUnidadRequest;
use App\Services\Unidades_services\listadoUnidadesServices;
use App\Services\Unidades_services\registroUnidadesServices;
use App\Services\Unidades_services\updateUnidadServices;

class unidadesController extends Controller
{

    protected $registroUnidades;
    protected $listadoUnidades;
    protected $actualizarUnidades;

    public function __construct(registroUnidadesServices $regisroUnidades, listadoUnidadesServices $listadoUnidades, updateUnidadServices $actualizarUnidades) {
        $this->registroUnidades = $regisroUnidades;
        $this->listadoUnidades = $listadoUnidades;
        $this->actualizarUnidades = $actualizarUnidades;
    }

    public function index(){
        return $this->listadoUnidades->getAllUnidades();
    }

    public function store(registroUnidadRequest $request){
        return $this->registroUnidades->registroUnidad($request);
    }

    public function show(string $id){
        //
    }

    public function update(actualizarUnidadRequest $request, string $id){
        return $this->actualizarUnidades->actualizarUnidad($request, $id);
    }

    public function destroy(string $id)    {
        //
    }
}
