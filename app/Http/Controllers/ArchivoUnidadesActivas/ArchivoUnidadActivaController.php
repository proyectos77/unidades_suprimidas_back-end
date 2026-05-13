<?php

namespace App\Http\Controllers\ArchivoUnidadesActivas;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchivoUnidadesActivas_request\registroArchivoUnidadesActivasRequest;
use App\Services\Archivo_services\registroArchivoUnidadesActivasServices;
use App\Services\ArchivosUnidadActiva_services\registroInformacionGeneralArchivoService;
use Illuminate\Http\Request;

class ArchivoUnidadActivaController extends Controller
{
    private $registroArchivoUnidadesActivas;

    public function __construct(registroInformacionGeneralArchivoService $registroArchivoUnidadesActivas) {
        $this->registroArchivoUnidadesActivas = $registroArchivoUnidadesActivas;
    }

    public function index()
    {
        return $this->registroArchivoUnidadesActivas->obtenerTodosLosArchivos();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(registroArchivoUnidadesActivasRequest $request)
    {
        return $this->registroArchivoUnidadesActivas->registroInformacionGeneralArchivoUnidadActiva($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idUnidad)
    {
        return $this->registroArchivoUnidadesActivas->obtenerArchivoPorIdUnidad($idUnidad);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function obtenerResumenAlmacenamiento($idUnidad)
    {
        return $this->registroArchivoUnidadesActivas->obtenerResumenAlmacenimientoUnidad($idUnidad);
    }

    public function obtenerDetalleEstructura($idUnidad)
    {
        return $this->registroArchivoUnidadesActivas->obtenerDetalleEstructuraUnidad($idUnidad);
    }

    public function obtenerEstantesPorCuerpo($idUnidad, $idCuerpo)
    {
        return $this->registroArchivoUnidadesActivas->obtenerEstantesPorCuerpoUnidad($idUnidad, $idCuerpo);
    }

    public function obtenerBaldasPorEstante($idUnidad, $idEstante)
    {
        return $this->registroArchivoUnidadesActivas->obtenerBaldasPorEstanteUnidad($idUnidad, $idEstante);
    }

    public function obtenerCajasPorBalda($idUnidad, $idBalda)
    {
        return $this->registroArchivoUnidadesActivas->obtenerCajasPorBaldaUnidad($idUnidad, $idBalda);
    }

    public function obtenerCarpetasPorCaja($idUnidad, $idCaja)
    {
        return $this->registroArchivoUnidadesActivas->obtenerCarpetasPorCajaUnidad($idUnidad, $idCaja);
    }

    public function obtenerInfoCarpeta($idUnidad, $idCarpeta)
    {
        return $this->registroArchivoUnidadesActivas->obtenerInfoCarpetaUnidad($idUnidad, $idCarpeta);
    }

    public function obtenerInfoCaja($idUnidad, $idCaja)
    {
        return $this->registroArchivoUnidadesActivas->obtenerInfoCajaUnidad($idUnidad, $idCaja);
    }

    public function obtenerCarpetaConCaja($idUnidad, $idCarpeta)
    {
        return $this->registroArchivoUnidadesActivas->obtenerCarpetaConCajaUnidad($idUnidad, $idCarpeta);
    }

    public function obtenerListadoCarpetasConCaja($idUnidad)
    {
        return $this->registroArchivoUnidadesActivas->obtenerListadoCarpetasConCajaUnidad($idUnidad);
    }
}
