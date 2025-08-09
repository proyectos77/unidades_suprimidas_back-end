<?php

namespace App\Http\Controllers\Dependencias;

use App\Http\Controllers\Controller;
use App\Services\Dependencia_services\listadoDependenciasHijasServices;
use App\Services\Dependencia_services\listadoDependenciasPadreService;
use Illuminate\Http\Request;

class DependenciasController extends Controller
{

    private $listadoDependenciasPadre;
    private $listadoDependenciasHijas;

    public function __construct(listadoDependenciasPadreService $listadoDependenciasPadre, listadoDependenciasHijasServices $listadoDependenciasHijas) {
        $this->listadoDependenciasPadre = $listadoDependenciasPadre;
        $this->listadoDependenciasHijas = $listadoDependenciasHijas;
    }

    public function index(){
        return $this->listadoDependenciasPadre->getListadoDependenciasPadre();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->listadoDependenciasHijas->getListadoDependenciasHijas($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function listadoDependenciasPadre(){

    }
}
