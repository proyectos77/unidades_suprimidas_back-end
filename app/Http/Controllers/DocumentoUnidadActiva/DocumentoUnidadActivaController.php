<?php

namespace App\Http\Controllers\DocumentoUnidadActiva;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentoUnidadActiva_request\RegistroDocumentoUnidadActivaRequest;
use App\Services\DocumentoUnidadActiva_services\RegistroDocumentoUnidadActivaService;
use Illuminate\Http\Request;

class DocumentoUnidadActivaController extends Controller
{
    protected $documentoUnidadActiva;

    public function __construct(RegistroDocumentoUnidadActivaService $documentoUnidadActiva)
    {
        $this->documentoUnidadActiva = $documentoUnidadActiva;
    }

    public function store(RegistroDocumentoUnidadActivaRequest $request)
    {
        return $this->documentoUnidadActiva->registroDocumentoUnidadActiva($request->validated());
    }

    public function index()
    {
        return $this->documentoUnidadActiva->listadoDocumentoUnidadActiva();
    }

    public function show($id)
    {
        return $this->documentoUnidadActiva->obtenerDocumentoUnidadActiva($id);
    }

    public function update(RegistroDocumentoUnidadActivaRequest $request, $id)
    {
        return $this->documentoUnidadActiva->actualizarDocumentoUnidadActiva($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->documentoUnidadActiva->eliminarDocumentoUnidadActiva($id);
    }

    public function obtenerDocumentosPorUnidad($idUnidad)
    {
        return $this->documentoUnidadActiva->obtenerDocumentosPorUnidad($idUnidad);
    }

    public function obtenerDocumentosPorCarpeta($idUnidad, $idCarpeta)
    {
        return $this->documentoUnidadActiva->obtenerDocumentosPorCarpetaUnidad($idUnidad, $idCarpeta);
    }
}
