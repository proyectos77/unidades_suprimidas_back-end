<?php

namespace App\Http\Controllers\Utilidades;

use App\Http\Controllers\Controller;
use App\Services\Utilidades_services\listAniosServices;
use Illuminate\Http\Request;

class utilController extends Controller
{

    private $anios;

    public function __construct(listAniosServices $anios) {
        $this->anios = $anios;
    }

    public function listAnio() {
       return $this->anios->getListAnios();
    }
}
