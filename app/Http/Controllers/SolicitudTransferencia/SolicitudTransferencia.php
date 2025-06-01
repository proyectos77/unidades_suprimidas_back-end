<?php

namespace App\Http\Controllers\SolicitudTransferencia;

use App\Http\Controllers\Controller;
use App\Services\SolicitudTransferencia\listadoSolicitudesTransferencia;
use Illuminate\Http\Request;

class SolicitudTransferencia extends Controller
{
    private $listadoSolicitudes;

    public function __construct(listadoSolicitudesTransferencia $listadoSolicitudes) {
        $this->listadoSolicitudes = $listadoSolicitudes;
    }

    public function index()
    {
        return $this->listadoSolicitudes->getListadoSolicitudesTransferencias();
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
