<?php

namespace App\Exceptions;

use App\Http\Responses\Responses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Personaliza la respuesta para excepciones de autenticación.
     */
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        /* return response()->json([
            'error' => true,
            'status' => 401,
            'mensaje' => 'No autenticado. Por favor, inicie sesión.',
            'data' => []
        ], 401); */

        return Responses::warning(401,'Sesion cerrada', 'Su sesión ha expirado. Por favor, inicie sesión nuevamente.', []);
    }
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
