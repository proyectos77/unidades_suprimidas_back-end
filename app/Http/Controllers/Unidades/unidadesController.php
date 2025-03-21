<?php

namespace App\Http\Controllers\Unidades;

use App\Http\Controllers\Controller;
use App\Services\Unidades_services\registroUnidadesServices;
use Illuminate\Http\Request;

class unidadesController extends Controller
{

    protected $registroUnidades;

    public function __construct(registroUnidadesServices $regisroUnidades) {
        $this->registroUnidades = $regisroUnidades;
    }

    public function index(){
        //
    }

    public function store(Request $request){
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
