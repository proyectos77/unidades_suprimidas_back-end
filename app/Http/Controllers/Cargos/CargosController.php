<?php

namespace App\Http\Controllers\Cargos;

use App\Http\Controllers\Controller;
use App\Services\cargos_services\listadoCargoServices;
use Illuminate\Http\Request;

class CargosController extends Controller
{

    protected $listadoCargos;

    public function __construct(listadoCargoServices $listadoCargos) {
        $this->listadoCargos = $listadoCargos;
    }

    public function index()
    {
        return $this->listadoCargos->listarCargos();
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
