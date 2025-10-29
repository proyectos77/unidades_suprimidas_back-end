<?php

namespace App\Http\Controllers\ArchivoUnidadesActivas;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchivoUnidadesActivas_request\registroArchivoUnidadesActivasRequest;
use App\Services\Archivo_services\registroArchivoUnidadesActivasServices;
use Illuminate\Http\Request;

class ArchivoUnidadActivaController extends Controller
{
    private $registroArchivoUnidadesActivas;

    public function __construct(registroArchivoUnidadesActivasServices $registroArchivoUnidadesActivas) {
        $this->registroArchivoUnidadesActivas = $registroArchivoUnidadesActivas;
    }

    public function index()
    {
        //
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
    public function store(registroArchivoUnidadesActivasRequest $request)
    {
        return $this->registroArchivoUnidadesActivas->registroArchivoUnidadesActivas($request);
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
