<?php

namespace App\Http\Controllers\CarpetaUnidadActiva;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarpetaUnidadActivas_request\registroCarpetaUnidadActivasRequest;
use App\Services\CarpetaUnidadActiva_services\registroCarpetaUnidadActivaServices;
use Illuminate\Http\Request;

class CarpetaUnidadActivaController extends Controller
{
    protected $carpetaUnidadActiva;

    public function __construct(registroCarpetaUnidadActivaServices $carpetaUnidadActiva)
    {
        $this->carpetaUnidadActiva = $carpetaUnidadActiva;
    }

    public function store(registroCarpetaUnidadActivasRequest $request)
    {
        return $this->carpetaUnidadActiva->registroCarpetaUnidadActiva($request->validated());
    }

    public function index()
    {
        return $this->carpetaUnidadActiva->listadoCarpetaUnidadActiva();
    }

    public function show($id)
    {
        return $this->carpetaUnidadActiva->obtenerCarpetaUnidadActiva($id);
    }

    public function update(registroCarpetaUnidadActivasRequest $request, $id)
    {
        return $this->carpetaUnidadActiva->actualizarCarpetaUnidadActiva($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->carpetaUnidadActiva->eliminarCarpetaUnidadActiva($id);
    }

    public function getCarpetasPorCaja($idCaja)
    {
        return $this->carpetaUnidadActiva->getCarpetasPorCaja($idCaja);
    }

    public function getCarpetasPorSubserie($idSubserie)
    {
        return $this->carpetaUnidadActiva->getCarpetasPorSubserie($idSubserie);
    }

    public function getCarpetasPorIdArchivoUnidadActiva($idArchivoUnidadActiva)
    {
        return $this->carpetaUnidadActiva->getCarpetasPorIdArchivoUnidadActiva($idArchivoUnidadActiva);
    }
}
