<?php

namespace App\Http\Controllers\Balda;

use App\Http\Controllers\Controller;
use App\Services\Balda_services\listadoBaldaServices;
use Illuminate\Http\Request;

class baldaController extends Controller
{
    protected $balda;

    public function __construct(listadoBaldaServices $balda)
    {
        $this->balda = $balda;
    }

    public function getBaldaPorEstante($idEstante)
    {
        return $this->balda->getBaldaPorEstante($idEstante);
    }
}
