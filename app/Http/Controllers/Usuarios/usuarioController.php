<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;
use App\Services\Usuarios_services\listadoUsuarios;
use App\Services\Usuarios_services\registroUsuarioServices;
use Illuminate\Http\Request;

class usuarioController extends Controller
{

    protected $registroUsuarios;
    protected $listadoUsuarios;

    public function __construct(registroUsuarioServices $registroUsuarios, listadoUsuarios $listadoUsuarios) {
        $this->registroUsuarios = $registroUsuarios;
        $this->listadoUsuarios = $listadoUsuarios;
    }

    public function index(){
        return $this->listadoUsuarios->listaUsuarios();
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
