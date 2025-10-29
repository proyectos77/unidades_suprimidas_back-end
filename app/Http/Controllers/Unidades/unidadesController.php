<?php

namespace App\Http\Controllers\Unidades;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidades_request\actualizarUnidadRequest;
use App\Http\Requests\Unidades_request\registroUnidadRequest;
use App\Services\Unidades_services\getAllUnidadesPorDependenciaService;
use App\Services\Unidades_services\getInformacionUnidad;
use App\Services\Unidades_services\getRutaUnidadActivaService;
use App\Services\Unidades_services\listadoUnidadesActivasService;
use App\Services\Unidades_services\listadoUnidadesArchivoSevice;
use App\Services\Unidades_services\listadoUnidadesConDetalleServices;
use App\Services\Unidades_services\listadoUnidadesHijasActivas;
use App\Services\Unidades_services\listadoUnidadesPadreActivas;
use App\Services\Unidades_services\listadoUnidadesServices;
use App\Services\Unidades_services\registroUnidadesServices;
use App\Services\Unidades_services\selectUnidadesServices;
use App\Services\Unidades_services\updateUnidadServices;

class unidadesController extends Controller
{
    protected $registroUnidades;
    protected $listadoUnidades;
    protected $actualizarUnidades;
    protected $selectUnidad;
    protected $informacionUnidad;
    protected $selectUndiadesConDetalle;
    protected $selectUnidadesArchivo;
    protected $getAllUnidadesPorDependencia;
    protected $listadoUnidadesActivas;
    protected $rutaArchivoUnidadActiva;
    protected $listadoUnidadesPadreActivas;
    protected $listadoUnidadesHijasActivas;

    public function __construct(
        registroUnidadesServices $registroUnidades,
        listadoUnidadesServices $listadoUnidades,
        updateUnidadServices $actualizarUnidades,
        selectUnidadesServices $selectUnidades,
        getInformacionUnidad $informacionUnidad,
        listadoUnidadesConDetalleServices $selectUndiadesConDetalle,
        listadoUnidadesArchivoSevice $selectUnidadesArchivo,
        getAllUnidadesPorDependenciaService $getAllUnidadesPorDependencia,
        listadoUnidadesActivasService $listadoUnidadesActivas,
        getRutaUnidadActivaService $rutaArchivoUnidadActiva,
        listadoUnidadesPadreActivas $listadoUnidadesPadreActivas,
        listadoUnidadesHijasActivas $listadoUnidadesHijasActivas
    ) {
        $this->registroUnidades = $registroUnidades;
        $this->listadoUnidades = $listadoUnidades;
        $this->actualizarUnidades = $actualizarUnidades;
        $this->selectUnidad = $selectUnidades;
        $this->informacionUnidad = $informacionUnidad;
        $this->selectUndiadesConDetalle = $selectUndiadesConDetalle;
        $this->selectUnidadesArchivo = $selectUnidadesArchivo;
        $this->getAllUnidadesPorDependencia = $getAllUnidadesPorDependencia;
        $this->listadoUnidadesActivas = $listadoUnidadesActivas;
        $this->rutaArchivoUnidadActiva = $rutaArchivoUnidadActiva;
        $this->listadoUnidadesPadreActivas = $listadoUnidadesPadreActivas;
        $this->listadoUnidadesHijasActivas = $listadoUnidadesHijasActivas;
    }

    public function index()
    {

    }

    public function store(registroUnidadRequest $request)
    {
        return $this->registroUnidades->registroUnidad($request);
    }

    public function show(string $id)
    {
        return $this->informacionUnidad->informacionUnidad($id);
    }

    public function update(actualizarUnidadRequest $request, string $id)
    {
        return $this->actualizarUnidades->actualizarUnidad($request, $id);
    }

    public function destroy(string $id)
    {
        //
    }

    public function selectListUnidades($idDependencia){
        return $this->selectUnidad->listadoCompletoUnidades($idDependencia);
    }

    public function selectListUnidadesConDetalle($idDependencia){
        return $this->selectUndiadesConDetalle->listadoUnidadesConDetalle($idDependencia);
    }

    public function selectListUnidadesArchivo($idDependencia){
        return $this->selectUnidadesArchivo->gatAllUnidadesArchivo($idDependencia);
    }

    public function getAllUnidadesPorDependencia($idDependencia)
    {
        return $this->getAllUnidadesPorDependencia->getAllUnidadesDependencia($idDependencia);
    }

    public function listadoUnidadesActivas($filtro = null)
    {
        return $this->listadoUnidadesActivas->getListadoUnidadesActivas($filtro);
    }

    public function listadoUnidadesSuprimidas($filtro = null)
    {
        return $this->listadoUnidades->getAllUnidades($filtro);
    }

    public function rutaUnidadActiva($idUnidad)
    {
        return $this->rutaArchivoUnidadActiva->getRuta($idUnidad);
    }

    public function listadoUnidadesPadreActivas()
    {
        return $this->listadoUnidadesPadreActivas->getListadoUnidadesPadreActivas();
    }

    public function listadoUnidadesActivasPorPadre($idUnidadPadre)
    {
        return $this->listadoUnidadesActivas->getListadoUnidadesActivas('', $idUnidadPadre);
    }

    public function listadoUnidadesHijasActivas($idUnidadPadre){
        return $this->listadoUnidadesHijasActivas->getListadoUnidadesHijasActivas($idUnidadPadre);

    }
}
