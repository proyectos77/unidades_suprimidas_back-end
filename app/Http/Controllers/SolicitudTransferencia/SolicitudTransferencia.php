<?php

namespace App\Http\Controllers\SolicitudTransferencia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudTransferencia\actualizarSolicitudRequest;
use App\Services\SolicitudTransferencia\actualizarSolicitudTransferenciaService;
use App\Services\SolicitudTransferencia\getInformacionSolicitudTransferencia;
use App\Services\SolicitudTransferencia\listadoSolicitudesTransferencia;
use Illuminate\Http\Request;

class SolicitudTransferencia extends Controller
{
    private $listadoSolicitudes;
    private $actualizarSolicitud;
    private $informacionSolicitud;

    public function __construct(listadoSolicitudesTransferencia $listadoSolicitudes, actualizarSolicitudTransferenciaService $actualizarSolicitud, getInformacionSolicitudTransferencia $informacionSolicitud) {
        $this->listadoSolicitudes = $listadoSolicitudes;
        $this->actualizarSolicitud = $actualizarSolicitud;
        $this->informacionSolicitud = $informacionSolicitud;
    }

    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        return $this->informacionSolicitud->getInformacion($id);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(actualizarSolicitudRequest $request, string $id){
        return $this->actualizarSolicitud->actualizarSolicitud($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listadoDeSolicitudesPorUsuario(String $idUsuario, String $idTipoUsuario) {
        return $this->listadoSolicitudes->getListadoSolicitudesTransferencias($idUsuario, $idTipoUsuario);
    }
}
