<?php

namespace App\Http\Controllers\documentacionSistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentosSistema\registroDocumentacionSistemaRequests;
use App\Services\DocumentacionSistema\consultaDocumentacionSistema;
use App\Services\DocumentacionSistema\registroDocumentacionSistema;

class DocumentacionSistemaController extends Controller
{
    protected $registroDocumentacionSistema;
    protected $consultaDocumentacionSistema;

    public function __construct(
        registroDocumentacionSistema $registroDocumentacionSistema,
        consultaDocumentacionSistema $consultaDocumentacionSistema
    ) {
        $this->registroDocumentacionSistema = $registroDocumentacionSistema;
        $this->consultaDocumentacionSistema = $consultaDocumentacionSistema;
    }

    public function index()
    {
        return $this->consultaDocumentacionSistema->consultaDocumentacionSistema();
    }

    public function store(registroDocumentacionSistemaRequests $request)
    {
        return $this->registroDocumentacionSistema->registroDocumentacion($request);
    }
}
