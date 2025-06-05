<?php

namespace App\Http\Controllers\Archivo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Archivo\registroArchivoRequest;
use App\Services\Archivo_services\listadoArchivoRegistradoPorUnidad;
use App\Services\Archivo_services\listArchivoPorUnidadServices;
use App\Services\Archivo_services\registroArchivoUnidadServices;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{

    private $registroArchivo;
    private $listArchivoPorUnidad;
    private $archivoPorUndiad;

    public function __construct(
        registroArchivoUnidadServices $registroArchivo,
        listArchivoPorUnidadServices $listArchivoPorUnidad,
        listadoArchivoRegistradoPorUnidad $listadoArchivoRegistradoPorUnidad
        ) {
        $this->registroArchivo = $registroArchivo;
        $this->listArchivoPorUnidad = $listArchivoPorUnidad;
        $this->archivoPorUndiad = $listadoArchivoRegistradoPorUnidad;
        /* $this->middleware('auth:sanctum')->only("store"); */
    }

    public function index(){

    }


    public function store(registroArchivoRequest $request){

        return $this->registroArchivo->registroArchivos($request);
    }

    public function show(string $id){

    }

    public function update(Request $request, string $id){
        //
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
