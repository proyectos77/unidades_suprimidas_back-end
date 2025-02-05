<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;
use App\Services\Usuarios_services\registroUsuarioServices;
use Illuminate\Http\Request;

class usuarioController extends Controller
{

    protected $registroUsuarios;

    public function __construct(registroUsuarioServices $registroUsuarios) {
        $this->registroUsuarios = $registroUsuarios;
    }

    public function index(){
    }

    public function store(registroUsuarioRequest $request){
        return $this->registroUsuarios->gestionRegistroUsuario($request);
    }

    public function show(string $id){
    }

    public function edit(string $id){

    }

    public function update(Request $request, string $id){

    }

    public function destroy(string $id){

    }
}
