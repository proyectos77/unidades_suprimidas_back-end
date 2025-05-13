<?php

namespace App\Http\Controllers\Transferencias;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transferencias\registroTransferenciaRequest;
use App\Services\Transferencias_services\registroTransferencia;
use App\Services\Transferencias_services\registroTransferenciaCompleto;
use Illuminate\Http\Request;

class transferenciasController extends Controller
{

    private $registroTransferencia;

    public function __construct(registroTransferenciaCompleto $registroTransferencia)
    {
        $this->registroTransferencia = $registroTransferencia;
    }

    public function index(){

    }

    public function store(registroTransferenciaRequest $request){

        return $this->registroTransferencia->registroSolicitudTransferencia($request);
    }

    public function show(string $id){
        //
    }

    public function update(Request $request, string $id){
        //
    }

    public function destroy(string $id){
        //
    }
}
