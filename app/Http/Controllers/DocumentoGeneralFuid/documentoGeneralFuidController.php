<?php

namespace App\Http\Controllers\DocumentoGeneralFuid;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentoGeneralFuid_request\registroDocumentoGeneralFuidRequest;
use App\Services\DocumentoGeneralFuid_services\registroDocumentoGeneralFuidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentoGeneralFuid\DocumentoGeneralFuidModel;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        //
    }

    public function store(registroDocumentoGeneralFuidRequest $request)
    {
        return $this->registroDocumentoGeneralFuid->registroDocumentoGeneralFuid($request);
    }

    public function show(string $id)
    {
        //
    }

    public function update(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function documentosPorCarpeta($idCarpeta)
    {
        return $this->registroDocumentoGeneralFuid->documentosPorCarpeta($idCarpeta);
    }

    public function buscar(Request $request)
    {
        return $this->registroDocumentoGeneralFuid->buscarDocumentos($request->all());
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
