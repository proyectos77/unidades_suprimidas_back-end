<?php

namespace App\Http\Controllers\TipoDocumental;

use App\Http\Controllers\Controller;
use App\Services\TipoDocumental_services\TipoDocumentalService;
use Illuminate\Http\Request;

class TipoDocumentalController extends Controller
{
    protected $tipoDocumentalService;

    public function __construct(TipoDocumentalService $tipoDocumentalService)
    {
        $this->tipoDocumentalService = $tipoDocumentalService;
    }

    public function index()
    {
        return $this->tipoDocumentalService->obtenerTodosLosTiposDocumentales();
    }

    public function show($id)
    {
        return $this->tipoDocumentalService->obtenerTipoDocumental($id);
    }

    public function store(Request $request)
    {
        return $this->tipoDocumentalService->crearTipoDocumental($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->tipoDocumentalService->actualizarTipoDocumental($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->tipoDocumentalService->eliminarTipoDocumental($id);
    }
}
