<?php

namespace App\Http\Controllers\CajaUnidadActiva;

use App\Http\Controllers\Controller;
use App\Http\Requests\CajaUnidadActivas_request\registroCajaUnidadActivasRequest;
use App\Services\CajaUnidadActiva_services\registroCajaUnidadActivaServices;
use Illuminate\Http\Request;

class CajaUnidadActivaController extends Controller
{
    protected $cajaUnidadActiva;

    public function __construct(registroCajaUnidadActivaServices $cajaUnidadActiva)
    {
        $this->cajaUnidadActiva = $cajaUnidadActiva;
    }

    public function store(registroCajaUnidadActivasRequest $request)
    {
        return $this->cajaUnidadActiva->registroCajaUnidadActiva($request->validated());
    }

    public function index()
    {
        return $this->cajaUnidadActiva->listadoCajaUnidadActiva();
    }

    public function show($id)
    {
        return $this->cajaUnidadActiva->obtenerCajaUnidadActiva($id);
    }

    public function update(registroCajaUnidadActivasRequest $request, $id)
    {
        return $this->cajaUnidadActiva->actualizarCajaUnidadActiva($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->cajaUnidadActiva->eliminarCajaUnidadActiva($id);
    }

    public function getCajasPorBalda($idBalda)
    {
        return $this->cajaUnidadActiva->getCajasPorBalda($idBalda);
    }

    public function getCajasPorCuerpo($idCuerpo)
    {
        return $this->cajaUnidadActiva->getCajasPorCuerpo($idCuerpo);
    }

    public function getCajasPorIdArchivoUnidadActiva($idArchivoUnidadActiva)
    {
        return $this->cajaUnidadActiva->getCajasPorIdArchivoUnidadActiva($idArchivoUnidadActiva);
    }
}
