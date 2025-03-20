<?php

namespace App\Http\Controllers\Departamentos;

use App\Http\Controllers\Controller;
use App\Services\Departamentos_services\listadoDepartamentosServices;
use Illuminate\Http\Request;

class departamentosController extends Controller
{

    protected $departamentos;

    public function __construct(listadoDepartamentosServices $departamentos) {
        $this->departamentos = $departamentos;
    }

    public function getAllDepartamentos() {
        return $this->departamentos->listadoDepartamentos();
    }
}
