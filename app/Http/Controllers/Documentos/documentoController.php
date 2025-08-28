<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Documento\informacionDocumentoService;
use App\Services\Documentos_services\registroDocumentosService;
use Illuminate\Http\Request;

class documentoController extends Controller
{

    private $informacionDocumento;
    private $registroDocumento;

    public function __construct(informacionDocumentoService $informacionDocumento, registroDocumentosService $registroDocumento) {
        $this->informacionDocumento = $informacionDocumento;
        $this->registroDocumento = $registroDocumento;
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
    public function store(Request $request)
    {
        return $this->registroDocumento->gestionRegistro($request, $op=1);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        return $this->informacionDocumento->verDocumento($id);
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
