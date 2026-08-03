<?php

namespace App\Http\Controllers\DocumentoGeneralFuid;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentoGeneralFuid_request\registroDetalleDocumentoGeneralFuidRequest;
use App\Services\DocumentoGeneralFuid_services\registroDetalleDocumentoGeneralFuidService;
use Illuminate\Http\Request;

class detalleDocumentoGeneralFuidController extends Controller
{
    protected $registroDetalleDocumentoGeneralFuid;

    public function __construct(
        registroDetalleDocumentoGeneralFuidService $registroDetalleDocumentoGeneralFuid
    ) {
        $this->registroDetalleDocumentoGeneralFuid = $registroDetalleDocumentoGeneralFuid;
    }

    public function index()
    {
        return $this->registroDetalleDocumentoGeneralFuid->listarDetalles();
    }

    public function store(registroDetalleDocumentoGeneralFuidRequest $request)
    {
        return $this->registroDetalleDocumentoGeneralFuid->registroDetalleDocumentoGeneralFuid($request);
    }

    public function show(string $id)
    {
        return $this->registroDetalleDocumentoGeneralFuid->obtenerDetalle($id);
    }

    public function update(registroDetalleDocumentoGeneralFuidRequest $request, string $id)
    {
        return $this->registroDetalleDocumentoGeneralFuid->actualizarDetalle($id, $request);
    }

    public function destroy(string $id)
    {
        return $this->registroDetalleDocumentoGeneralFuid->eliminarDetalle($id);
    }

    public function detallesPorDocumento($idDocumentoGeneral)
    {
        return $this->registroDetalleDocumentoGeneralFuid->detallesPorDocumento($idDocumentoGeneral);
    }

    public function detallesPorCarpeta($idCarpeta)
    {
        return $this->registroDetalleDocumentoGeneralFuid->detallesPorCarpeta($idCarpeta);
    }

    public function buscar(Request $request)
    {
        return $this->registroDetalleDocumentoGeneralFuid->buscarDetalles($request->all());
    }
}
