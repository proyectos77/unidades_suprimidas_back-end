<?php

namespace App\Http\Controllers\Archivo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos_request\actualizarArchivoRequest;
use App\Http\Requests\Archivos_request\registroArchivoRequest;
use App\Services\Archivo_services\listadoArchivoRegistradoPorUnidad;
use App\Services\Archivo_services\listArchivoPorUnidadServices;
use App\Services\Archivo_services\registroArchivoUnidadServices;
use App\Services\Archivo_services\updateArchivoUnidadServices;
use Illuminate\Http\Request;

class archivoController extends Controller
{

    private $registroArchivo;
    private $listArchivoPorUnidad;
    private $archivoPorUndiad;
    private $updateArchivo;

    public function __construct(
        registroArchivoUnidadServices $registroArchivo,
        listArchivoPorUnidadServices $listArchivoPorUnidad,
        listadoArchivoRegistradoPorUnidad $listadoArchivoRegistradoPorUnidad,
        updateArchivoUnidadServices $updateArchivo
        ) {
        $this->registroArchivo = $registroArchivo;
        $this->listArchivoPorUnidad = $listArchivoPorUnidad;
        $this->archivoPorUndiad = $listadoArchivoRegistradoPorUnidad;
        $this->updateArchivo = $updateArchivo;
        /* $this->middleware('auth:sanctum')->only("store"); */
    }

    public function index(){

    }


    public function store(registroArchivoRequest $request){

        return $this->registroArchivo->registroArchivos($request);
    }

    public function show(string $id){

    }

    public function update(actualizarArchivoRequest $request, string $id){
        return $this->updateArchivo->actualizarArchivo($request, $id);
    }

    public function destroy(string $id){
        //
    }

    public function listArchivoPorUnidad($idDetalleUnidad){
        return $this->listArchivoPorUnidad->getAllArchivoPorUnidad($idDetalleUnidad);
    }

    public function archivoPorUnidad($idDetalleUnidad){
        return $this->archivoPorUndiad->getArchivosPorUnidad($idDetalleUnidad);
    }

}
