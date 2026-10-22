<?php

namespace App\Http\Controllers\OrganizacionTransferencia;

use App\Http\Controllers\Controller;
use App\Http\Requests\CajaUnidadActivas_request\registroCajaUnidadActivasRequest;
use App\Http\Requests\CarpetaUnidadActivas_request\registroCarpetaUnidadActivasRequest;
use App\Services\OrganizacionTransferencia_services\organizacionTransferenciaService;

class OrganizacionTransferenciaController extends Controller
{
    protected $organizacion;

    public function __construct(organizacionTransferenciaService $organizacion)
    {
        $this->organizacion = $organizacion;
    }

    public function vigencias($idUnidad)
    {
        return $this->organizacion->vigenciasAprobadas($idUnidad);
    }

    public function seriesTransferidas($idUnidad, $anio)
    {
        return $this->organizacion->seriesTransferidas($idUnidad, $anio);
    }

    public function registrarCajas(registroCajaUnidadActivasRequest $request)
    {
        return $this->organizacion->registrarCajas($request->validated());
    }

    public function registrarCarpetas(registroCarpetaUnidadActivasRequest $request)
    {
        return $this->organizacion->registrarCarpetas($request->validated());
    }
}
