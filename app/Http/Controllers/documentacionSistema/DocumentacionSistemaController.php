<?php

namespace App\Http\Controllers\documentacionSistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentosSistema\actualizarDocumentacionSistemaRequests;
use App\Http\Requests\DocumentosSistema\registroDocumentacionSistemaRequests;
use App\Services\DocumentacionSistema\consultaDocumentacionSistema;
use App\Services\DocumentacionSistema\gestionDocumentacionSistema;
use App\Services\DocumentacionSistema\registroDocumentacionSistema;

class DocumentacionSistemaController extends Controller
{
    protected $registroDocumentacionSistema;
    protected $consultaDocumentacionSistema;
    protected $gestionDocumentacionSistema;

    public function __construct(
        registroDocumentacionSistema $registroDocumentacionSistema,
        consultaDocumentacionSistema $consultaDocumentacionSistema,
        gestionDocumentacionSistema $gestionDocumentacionSistema
    ) {
        $this->registroDocumentacionSistema = $registroDocumentacionSistema;
        $this->consultaDocumentacionSistema = $consultaDocumentacionSistema;
        $this->gestionDocumentacionSistema = $gestionDocumentacionSistema;
    }

    public function index()
    {
        return $this->consultaDocumentacionSistema->consultaDocumentacionSistema();
    }

    public function activos()
    {
        return $this->consultaDocumentacionSistema->consultaDocumentacionActiva();
    }

    public function store(registroDocumentacionSistemaRequests $request)
    {
        return $this->registroDocumentacionSistema->registroDocumentacion($request);
    }

    public function update(actualizarDocumentacionSistemaRequests $request, string $id)
    {
        return $this->gestionDocumentacionSistema->actualizarDocumentacion($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->gestionDocumentacionSistema->inactivarDocumentacion($id);
    }

    public function visualizar(string $id)
    {
        return $this->gestionDocumentacionSistema->visualizarDocumentacion($id);
    }
}
