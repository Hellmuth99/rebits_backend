<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VehiculosController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/usuarios')->group(function () {
    Route::get('/', [UsuariosController::class, 'getUsuarios']);
    Route::get('/list', [UsuariosController::class, 'listUsuarios']);

    Route::post('/crearUsuario', [UsuariosController::class, 'crearUsuario']); //web
    Route::get('/detalleUsuario', [UsuariosController::class, 'detalleUsuario']); // Mostrar un usuario específico
    Route::post('/editarUsuario', [UsuariosController::class, 'editarUsuario']); //web
    Route::post('/eliminarUsuario', [UsuariosController::class, 'eliminarUsuario']); //web

});


Route::prefix('/vehiculos')->group(function () {
    Route::get('/', [VehiculosController::class, 'getVehiculos']);

    Route::post('/crearVehiculo', [VehiculosController::class, 'crearVehiculo']); //web
    Route::get('/detalleVehiculo', [VehiculosController::class, 'detalleVehiculo']); // Mostrar un usuario específico
    Route::post('/editarVehiculo', [VehiculosController::class, 'editarVehiculo']); //web
    Route::post('/eliminarVehiculo', [VehiculosController::class, 'eliminarVehiculo']); //web

});






Route::post('/import', [ImportController::class, 'importExcel']);
