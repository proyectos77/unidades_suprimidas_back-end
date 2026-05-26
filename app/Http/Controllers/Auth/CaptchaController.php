<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    private const CAPTCHA_TTL = 300; // 5 minutos en segundos

    /**
     * Generar código CAPTCHA aleatorio
     */
    public function generate(Request $request)
    {
        $code = $this->generarCodigoAleatorio();
        $now = now();
        $expiresAt = $now->copy()->addSeconds(self::CAPTCHA_TTL);

        // Guardar código y timestamp en sesión
        session(['captcha_code' => $code]);
        session(['captcha_timestamp' => $now]);
        session(['captcha_expires_at' => $expiresAt]);

        return response()->json([
            'captcha' => $code,
            'expiresAt' => $expiresAt->timestamp,
            'ttl' => self::CAPTCHA_TTL,
            'message' => 'Código CAPTCHA generado correctamente'
        ]);
    }

    /**
     * Validar CAPTCHA en el login
     */
    public function validar(Request $request)
    {
        $captchaIngresado = $request->input('captcha');
        $captchaGuardado = session('captcha_code');
        $captchaExpiresAt = session('captcha_expires_at');

        // Validar que el código existe
        if (!$captchaGuardado) {
            return response()->json([
                'error' => 'CAPTCHA no generado',
                'action' => 'refresh'
            ], 400);
        }

        // Validar que el código es correcto (case sensitive)
        if ($captchaIngresado !== $captchaGuardado) {
            return response()->json([
                'error' => 'El código de seguridad es incorrecto',
                'action' => 'retry'
            ], 400);
        }

        // Validar que no ha expirado
        if (now()->greaterThan($captchaExpiresAt)) {
            session()->forget(['captcha_code', 'captcha_timestamp', 'captcha_expires_at']);
            return response()->json([
                'error' => 'El código de seguridad ha expirado',
                'action' => 'refresh'
            ], 400);
        }

        // CAPTCHA válido, eliminarlo de la sesión
        session()->forget(['captcha_code', 'captcha_timestamp', 'captcha_expires_at']);

        return response()->json([
            'success' => true,
            'message' => 'CAPTCHA validado correctamente'
        ]);
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
