<?php

namespace App\Http\Controllers\DetalleTransferencia;

use App\Http\Controllers\Controller;
use App\Services\Detalle_de_transferencia_services\listadoDetalleTransferenciaService;
use Illuminate\Http\Request;

class detalleTransferenciaController extends Controller
{

    private $solicitudesTrasnferencias;

    public function __construct(listadoDetalleTransferenciaService $solicitudesTrasnferencias) {
        $this->solicitudesTrasnferencias = $solicitudesTrasnferencias;
    }

    public function index()
    {

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
        return $this->solicitudesTrasnferencias->listadoDetalle($id);
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
