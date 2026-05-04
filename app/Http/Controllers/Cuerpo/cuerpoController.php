<?php

namespace App\Http\Controllers\Cuerpo;

use App\Http\Controllers\Controller;
use App\Services\Cuerpo_services\listadoCuerpoServices;
use Illuminate\Http\Request;

class cuerpoController extends Controller
{
    protected $cuerpo;

    public function __construct(listadoCuerpoServices $cuerpo)
    {
        $this->cuerpo = $cuerpo;
    }

    public function getAllCuerpo()
    {
        return $this->cuerpo->getAllCuerpo();
    }
}
