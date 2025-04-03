<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Cargos\CargosController;
use App\Http\Controllers\Departamentos\departamentosController;
use App\Http\Controllers\DetalleUnidad\DetalleUnidadController;
use App\Http\Controllers\Municipios\municipiosController;
use App\Http\Controllers\TiposUsuarios\tipoUsuariosController;
use App\Http\Controllers\Unidades\unidadesController;
use App\Http\Controllers\Usuarios\usuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */



        Route::post('login', [authController::class, 'login']); //login

        Route::apiResource('usuarios', usuarioController::class); //Usuarios
        Route::apiResource('tipoUsuarios', tipoUsuariosController::class); //tipoUsuarios
        Route::apiResource('cargos', CargosController::class); //tipoUsuarios
        Route::apiResource('unidades', unidadesController::class);
        Route::apiResource('detalleUnidad', DetalleUnidadController::class);

        Route::get('departamentos', [departamentosController::class, 'getAllDepartamentos']);

        Route::get('municipios/{idDepartamento}', [municipiosController::class, 'getAllMunicipios']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('logout', [authController::class, 'logout']);
        });
