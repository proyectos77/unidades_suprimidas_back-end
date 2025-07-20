<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Services\DocumentosTransferencias_services\listadoDocumentosService;
use Illuminate\Http\Request;

class documentosTransferenciaController extends Controller
{
    private $listadoDocumentos;

    public function __construct(listadoDocumentosService $listadoDocumentos) {
        $this->listadoDocumentos = $listadoDocumentos;
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
    public function show(string $id){
        return $this->listadoDocumentos->listarDocumentos($id);
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
