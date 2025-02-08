<?php

namespace App\Http\Controllers\TiposUsuarios;

use App\Http\Controllers\Controller;
use App\Services\TiposUsuarios_services\listaTiposUsuarios;
use Illuminate\Http\Request;

class tipoUsuariosController extends Controller
{

    protected $listarTiposUsuarios;

    public function __construct(listaTiposUsuarios $listarTiposUsuarios) {
        $this->listarTiposUsuarios = $listarTiposUsuarios;
    }

    public function index(){
        return $this->listarTiposUsuarios->listadoTipoUsuarios();
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
        //
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
        //
    }
}
