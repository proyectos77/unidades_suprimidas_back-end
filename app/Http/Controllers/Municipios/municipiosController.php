<?php

namespace App\Http\Controllers\Municipios;
use App\Http\Controllers\Controller;
use App\Services\Municipios_services\listadoMunicipiosServices;

class municipiosController extends Controller
{

    protected $municipiosServices;
    public function __construct(listadoMunicipiosServices $municipiosServices) {
        $this->municipiosServices = $municipiosServices;
    }

    public function getAllMunicipios($idDepartamento) {
        return $this->municipiosServices->listadoMunicipiosPorDepartamento($idDepartamento);
    }

}
