<?php

namespace App\Http\Middleware;

use App\Http\Responses\Responses;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['mensaje' => 'Token no proporcionado'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken) {
            return response()->json(['mensaje' => 'Token inválido'], 401);
        }

        if ($accessToken->expires_at && now()->greaterThan($accessToken->expires_at)) {
            // Eliminar el token vencido
            $accessToken->delete();
            return response()->json([
                'error' => true,
                'status' => 401,
                'mensaje' => 'Su sesión ha expirado. Por favor, inicie sesión nuevamente.',
                'data' => []
            ], 401);
        }

        // Renovar expiración por inactividad (10 minutos desde la última petición)
        $accessToken->expires_at = now()->addMinutes(10);
        $accessToken->save();

        return $next($request);
    }
}
