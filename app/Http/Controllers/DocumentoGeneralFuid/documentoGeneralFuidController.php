<?php

namespace App\Http\Controllers\DocumentoGeneralFuid;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentoGeneralFuid_request\registroDocumentoGeneralFuidRequest;
use App\Services\DocumentoGeneralFuid_services\registroDocumentoGeneralFuidService;
use Illuminate\Http\Request;

class documentoGeneralFuidController extends Controller
{
    protected $registroDocumentoGeneralFuid;

    public function __construct(
        registroDocumentoGeneralFuidService $registroDocumentoGeneralFuid
    ) {
        $this->registroDocumentoGeneralFuid = $registroDocumentoGeneralFuid;
    }

    public function index()
    {
        return $this->registroDocumentoGeneralFuid->listarDocumentos();
    }

    public function store(registroDocumentoGeneralFuidRequest $request)
    {
        return $this->registroDocumentoGeneralFuid->registroDocumentoGeneralFuid($request);
    }

    public function show(string $id)
    {
        return $this->registroDocumentoGeneralFuid->obtenerDocumento($id);
    }

    public function update(registroDocumentoGeneralFuidRequest $request, string $id)
    {
        return $this->registroDocumentoGeneralFuid->actualizarDocumento($id, $request);
    }

    public function destroy(string $id)
    {
        return $this->registroDocumentoGeneralFuid->eliminarDocumento($id);
    }

    public function documentosPorCaja($idCaja)
    {
        return $this->registroDocumentoGeneralFuid->documentosPorCaja($idCaja);
    }

    public function subirArchivoExcel(Request $request)
    {
        return $this->registroDocumentoGeneralFuid->subirArchivoExcel($request);
    }

    public function descargar($id)
    {
        return $this->registroDocumentoGeneralFuid->descargarDocumento($id);
    }
}
