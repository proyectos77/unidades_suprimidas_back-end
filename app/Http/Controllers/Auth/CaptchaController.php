<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    /**
     * Generar código CAPTCHA aleatorio
     */
    public function generate(Request $request)
    {
        $code = $this->generarCodigoAleatorio();

        session(['captcha_code' => $code]);
        session(['captcha_timestamp' => now()]);

        return response()->json(['captcha' => $code]);
    }

    /**
     * Validar CAPTCHA en el login
     */
    public function validar(Request $request)
    {
        $captchaIngresado = $request->input('captcha');
        $captchaGuardado = session('captcha_code');
        $captchaTimestamp = session('captcha_timestamp');

        // Validar que el código existe y es correcto
        if (!$captchaGuardado || $captchaIngresado !== $captchaGuardado) {
            return response()->json(['error' => 'CAPTCHA inválido'], 400);
        }

        // Validar TTL (5 minutos)
        if (now()->diffInMinutes($captchaTimestamp) > 5) {
            session()->forget('captcha_code');
            return response()->json(['error' => 'CAPTCHA expirado'], 400);
        }

        // CAPTCHA válido, eliminarlo de la sesión
        session()->forget(['captcha_code', 'captcha_timestamp']);

        return response()->json(['success' => true]);
    }

    /**
     * Generar código aleatorio (7 caracteres)
     */
    private function generarCodigoAleatorio()
    {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codigo = '';

        for ($i = 0; $i < 7; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $codigo;
    }
}
