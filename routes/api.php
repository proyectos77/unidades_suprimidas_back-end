<?php

use App\Http\Controllers\Archivo\archivoController;
use App\Http\Controllers\ArchivoUnidadesActivas\ArchivoUnidadActivaController;
use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Cargos\cargosController;
use App\Http\Controllers\Departamentos\departamentosController;
use App\Http\Controllers\Dependencias\dependenciasController;
use App\Http\Controllers\DetalleTransferencia\detalleTransferenciaController;
use App\Http\Controllers\DetalleUnidad\detalleUnidadController;
use App\Http\Controllers\Documentos\documentoController;
use App\Http\Controllers\Documentos\documentosTransferenciaController;
use App\Http\Controllers\Municipios\municipiosController;
use App\Http\Controllers\Otros\otrosController;
use App\Http\Controllers\Serie\serieController;
use App\Http\Controllers\SolicitudTransferencia\solicitudTransferencia;
use App\Http\Controllers\Subserie\subserieController;
use App\Http\Controllers\TiposUsuarios\tipoUsuariosController;
use App\Http\Controllers\Transferencias\transferenciasController;
use App\Http\Controllers\Unidades\unidadesController;
use App\Http\Controllers\Usuarios\usuarioController;
use App\Http\Controllers\Utilidades\utilController;
use Illuminate\Routing\Router;
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

    Route::apiResource('archivoUnidadesActivas', ArchivoUnidadActivaController::class); //archivoUnidadesActivas

    Route::get('rutaunidadactiva/{idUnidad}', [unidadesController::class, 'rutaUnidadActiva']);
    Route::get('observacionUnidadActiva/{observacion}', [detalleUnidadController::class, 'buscarObservacionUnidadActiva']);

    Route::get('unidadPadreActivas', [unidadesController::class, 'listadoUnidadesPadreActivas']);
    Route::get('listadoUnidadesActivasPorPadre/{idUnidadPadre}', [unidadesController::class, 'listadoUnidadesActivasPorPadre']);

    Route::get('listadoUnidadesHijasActivas/{idPadre}', [unidadesController::class, 'listadoUnidadesHijasActivas']);

    Route::get('unidadesPorDependencia/{idDependencia}', [unidadesController::class, 'getAllUnidadesPorDependencia']);
    Route::get('listadoUnidadesActivas/{filtro?}', [unidadesController::class, 'listadoUnidadesActivas']);

    Route::get('selectUnidadesArchivo/{idDependencia}', [unidadesController::class, 'selectListUnidadesArchivo']);

    Route::get('selectArchivoPorUnidad/{idDetalleUnidad}', [archivoController::class, 'listArchivoPorUnidad']);

    Route::middleware(['auth:sanctum', 'token.expiration'])->group(function () {
        Route::apiResource('usuarios', usuarioController::class); //Usuarios

        Route::apiResource('tipoUsuarios', tipoUsuariosController::class); //tipoUsuarios

        Route::apiResource('cargos', cargosController::class); //tipoUsuarios



        Route::apiResource('solicitudesTransferencias', solicitudTransferencia::class);

        Route::apiResource('detalleUnidad', detalleUnidadController::class);

        Route::apiResource('registroArchivo', archivoController::class);

        Route::apiResource('detalleTransferencia', detalleTransferenciaController::class);

        Route::apiResource('documentosTransferencia', documentosTransferenciaController::class);

        Route::apiResource('documento', documentoController::class);

        Route::apiResource('dependencias', dependenciasController::class);

        Route::apiResource('otros', otrosController::class);


        Route::get('listadoUnidadesSuprimidas/{filtro?}', [unidadesController::class, 'listadoUnidadesSuprimidas']);
        Route::get('unidadesPorDependencia/{idDependencia}/{filtro?}', [unidadesController::class, 'getAllUnidadesPorDependencia']);
        Route::apiResource('unidades', unidadesController::class);

        Route::get('series/{anio}', [serieController::class, 'listadoSeriesPorAnio']);
        Route::get('subseries/{idSerie}', [subserieController::class, 'listadoSubSeriesPorSerie']);
        Route::get('selectUnidades/{idDependencia}', [unidadesController::class, 'selectListUnidades']);
        Route::get('selectUnidadConDetalle/{idDependencia}', [unidadesController::class, 'selectListUnidadesConDetalle']);

        Route::get('anios', [utilController::class, 'listAnio']);

        Route::get('archivoPorUnidad/{idDetalleUnidad}', [archivoController::class, 'archivoPorUnidad']);
        Route::get('listadoTransferenciasPorArchivo/{idArchivo}', [transferenciasController::class, 'listadoTransferenciaPorArchivo']);
        Route::get('listadoSolicitudes/{idUsuario}/{idTipoUsuario}', [solicitudTransferencia::class, 'listadoDeSolicitudesPorUsuario']);
        Route::get('departamentos', [departamentosController::class, 'getAllDepartamentos']);
        Route::get('municipios/{idDepartamento}', [municipiosController::class, 'getAllMunicipios']);

        Route::get('notificaciones', [solicitudTransferencia::class, 'listadoNotificaciones']);
        Route::get('observacion/{observacion}/{idDependencia}', [detalleUnidadController::class, 'buscarObservacion']);

        Route::get('logout', [authController::class, 'logout']);
        Route::apiResource('transferencia', transferenciasController::class);
    });
