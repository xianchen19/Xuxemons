<?php

use App\Http\Controllers\amigosController;
use App\Http\Controllers\DailyChuches;
use App\Http\Controllers\enfermedadesController;
use App\Http\Controllers\EvoConfigController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\xuxemonController;
use App\Http\Controllers\inventarioController;
use App\Http\Controllers\ChatController;



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

Route::middleware(['cors'])->group(function () {
    // Rutas que no requieren permisos de rol
    Route::post('/userRegister', [RegisterController::class, 'store']);
    Route::post('/userLogin', [LoginController::class, 'login']);
    Route::get('/xuxemons/user', [xuxemonController::class, 'index']);
    Route::get('/xuxemons/verXuxemon', [xuxemonController::class, 'show']);
    Route::get('/users/coleccion', [xuxemonController::class, 'coleccion']);
    Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']);
    Route::get('/give_chuche/{xuxemonId}/{candyAmount}', [enfermedadesController::class, 'giveCandy']);
    Route::put('/xuxemons/{xuxemonId}/activate', [xuxemonController::class, 'activarXuxemon']);
    Route::get('/random_chuche', [inventarioController::class, 'randomChuche']);
    Route::put('/xuxemons/{xuxemonId}/deactivate', [xuxemonController::class, 'desactivarXuxemon']);
    Route::get('/inventario', [InventarioController::class, 'index']);
    Route::post('/add-daily-chuches', [DailyChuches::class, 'addDailyChuches']);
    Route::post('/usarCura/{xuxemonId}/{objeto}', [enfermedadesController::class, 'usarCura']);
    Route::get('/hospital', [enfermedadesController::class, 'xuxemonsConEnfermedad']);
    Route::get('/amigos', [amigosController::class, 'index']);
    Route::post('/amigos', [amigosController::class, 'store']);
    Route::delete('/amigos', [amigosController::class, 'destroy']);
    Route::post('/amigos/aceptar/{userTag}', [amigosController::class, 'aceptarSolicitud']);
    Route::post('/amigos/rechazar/{userTag}', [amigosController::class, 'rechazarSolicitud']);
    Route::get('/buscar-usuarios', [amigosController::class, 'buscarUsuarios']);
    Route::get('/amigos/pendientes', [amigosController::class, 'solicitudesPendientes']);
    Route::get('/chat/{userTag}', [ChatController::class, 'index']);
    Route::post('/mensaje/{userTag}', [ChatController::class, 'enviarMensaje']);
    Route::delete('/borrarChat', [ChatController::class, 'destroy']);

    // Rutas para el administrador
    Route::middleware(['role'])->group(function () {
        Route::post('/xuxemons/crearXuxemon', [xuxemonController::class, 'store']);
        Route::put('/xuxemons/update', [xuxemonController::class, 'update']);
        Route::delete('/xuxemons/delete', [xuxemonController::class, 'destroy']);
        Route::get('/xuxemons', [xuxemonController::class, 'xuxemonAll']);
        Route::get('/randomXuxemonAdmin', [xuxemonController::class, 'randomXuxemonAdmin']);
        Route::get('/random_chucheAdmin', [inventarioController::class, 'randomChucheAdmin']);
        Route::get('/configurations', [EvoConfigController::class, 'index']);
        Route::put('/configurations/{id}', [EvoConfigController::class, 'update']);
        Route::get('/inventarioAdmin', [InventarioController::class, 'showInventory']);
        Route::put('/configurations/chuches-diarias', [EvoConfigController::class, 'updateDailyChuches']);
        Route::put('/enfermedades/configuracion', [enfermedadesController::class, 'update']);
        Route::put('/enfermedades/confBajon', [enfermedadesController::class, 'updateXuxesBajon']);
    });
});
