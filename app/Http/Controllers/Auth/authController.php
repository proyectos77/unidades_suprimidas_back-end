<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\UsuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function login(Request $request) {


        if (!Auth::attempt(['user_usuario' => $request->user_usuario, 'password' => $request->password_usuario])) {
            return response()->json(['mensaje' => 'El usuario o la contraseña no coincide.',
                                    'accessToken' => '',       // Token generado
                                    'token_type' => '',      // Tipo de token
                                    'usuario' => [], 401]);
        }

        $usuario = UsuariosModel::with('tipoUsuario', 'permisos')->where('user_usuario', $request['user_usuario'])->firstOrFail();
        $tokenResult = $usuario->createToken('auth_token');
        $token = $tokenResult->plainTextToken;
        // Guardar expiración de token (10 minutos)
        $tokenResult->accessToken->expires_at = now()->addMinutes(10);
        $tokenResult->accessToken->save();

        return response()->json([
            'mensaje' => 'Bienbenido ' . $usuario->nombre_usuario,
            'accessToken' => $token,       // Token generado
            'token_type' => 'Bearer',      // Tipo de token
            'usuario' => [                 // Información del usuario
                'id' => $usuario->id_usuario,
                'nombre' => $usuario->nombre_usuario,
                'email' => $usuario->email_usuario,
                'rol' => $usuario->tipoUsuario->nombre_tipo_usuario,
                'idTipoUsuario' => $usuario->tipoUsuario->id_tipo_usuario,
                'idDependencia' => $usuario->id_dependencia,
                'permiso' => $usuario->nombre_permiso, // Obtener solo los nombres de los permisos
                'permiso_id' => $usuario->id_permiso // Obtener solo los IDs de los permisos
            ]
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['status' => 'Cierre de sesion', 'mensaje'=>'ha finalizado la sesion exitosamente', 'status' => 'success'],200);
    }
}
