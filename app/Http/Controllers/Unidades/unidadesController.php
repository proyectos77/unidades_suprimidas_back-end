<?php

namespace App\Http\Controllers\Unidades;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidades_request\registroUnidadRequest;
use App\Services\Unidades_services\listadoUnidadesServices;
use App\Services\Unidades_services\registroUnidadesServices;
use App\Services\Usuarios_services\listadoUsuarios;
use Illuminate\Http\Request;

class unidadesController extends Controller
{

    protected $registroUnidades;
    protected $listadoUnidades;

    public function __construct(registroUnidadesServices $regisroUnidades, listadoUnidadesServices $listadoUnidades) {
        $this->registroUnidades = $regisroUnidades;
        $this->listadoUnidades = $listadoUnidades;
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

    public function update(Request $request, string $id){
        //
    }

    public function destroy(string $id)    {
        //
    }
}
