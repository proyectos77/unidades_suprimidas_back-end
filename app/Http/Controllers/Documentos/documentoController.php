<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Documento\informacionDocumentoService;
use App\Http\Responses\Responses;
use App\Services\Documentos_services\registroDocumentosService;
use App\Services\Documentos_services\visualizarDocumentoService;
use Illuminate\Http\Request;

class documentoController extends Controller
{
    private $informacionDocumento;
    private $registroDocumento;
    private $visualizarDocumento;

    public function __construct(
        informacionDocumentoService $informacionDocumento,
        registroDocumentosService $registroDocumento,
        visualizarDocumentoService $visualizarDocumento
    ) {
        $this->informacionDocumento = $informacionDocumento;
        $this->registroDocumento = $registroDocumento;
        $this->visualizarDocumento = $visualizarDocumento;
    }

    public function store(Request $request)
    {
        try {
            return $this->registroDocumento->gestionRegistro($request, $op = 1);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            return Responses::error(422, 'Error de validación', $e->getMessage(), '');
        }
    }

    public function show(string $id)
    {
        return $this->informacionDocumento->verDocumento($id);
    }

    public function visualizarDocumento(string $id)
    {
        return $this->visualizarDocumento->visualizarDocumento($id);
    }
}
