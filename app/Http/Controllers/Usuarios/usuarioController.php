<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\Usuarios_requests\actualizarUsuarioRequest;
use App\Http\Requests\Request\Usuarios_requests\registroUsuarioRequest;
use App\Services\Usuarios_services\actualizarUsuariosServices;
use App\Services\Usuarios_services\listadoUsuarios;
use App\Services\Usuarios_services\registroUsuarioServices;
use Illuminate\Http\Request;

class usuarioController extends Controller
{

    protected $registroUsuarios;
    protected $listadoUsuarios;
    protected $actualizarUsuario;

    public function __construct(registroUsuarioServices $registroUsuarios, listadoUsuarios $listadoUsuarios, actualizarUsuariosServices $actualizarUsuario) {
        $this->registroUsuarios = $registroUsuarios;
        $this->listadoUsuarios = $listadoUsuarios;
        $this->actualizarUsuario = $actualizarUsuario;
    }

    public function index(){
        return $this->listadoUsuarios->listaUsuarios();
    }

    public function store(registroUsuarioRequest $request){
        return $this->registroUsuarios->gestionRegistroUsuario($request);
    }

    public function show(string $id){
    }

    public function update(actualizarUsuarioRequest $request, string $id){
        return $this->actualizarUsuario->actualizarUsuario($request, $id);

    }

    public function destroy(string $id){

    }
}
