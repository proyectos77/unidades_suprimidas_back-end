<?php

namespace App\Http\Controllers\Estante;

use App\Http\Controllers\Controller;
use App\Services\Estante_services\listadoEstanteServices;
use Illuminate\Http\Request;

class estanteController extends Controller
{
    protected $estante;

    public function __construct(listadoEstanteServices $estante)
    {
        $this->estante = $estante;
    }

    public function getEstantePorCuerpo($idCuerpo)
    {
        return $this->estante->getEstantePorCuerpo($idCuerpo);
    }
}
