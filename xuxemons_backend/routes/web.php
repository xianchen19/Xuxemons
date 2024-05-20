<?php

use App\Http\Controllers\amigosController;
use App\Http\Controllers\DailyChuches;
use App\Http\Controllers\enfermedadesController;
use App\Http\Controllers\EvoConfigController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\xuxemonController;
use App\Http\Controllers\inventarioController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\IntercambioXuxemons;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['cors'])->group(function () {
    // Rutas que no requieren permisos de rol
    //Auth
    Route::post('/userRegister', [RegisterController::class, 'store']);
    Route::post('/userLogin', [LoginController::class, 'login']);
    
    //Xuxemons
    Route::get('/xuxemons/user', [xuxemonController::class, 'index']);
    Route::get('/xuxemons/verXuxemon', [xuxemonController::class, 'show']);
    Route::get('/users/coleccion', [xuxemonController::class, 'coleccion']);
    Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']);
    Route::put('/xuxemons/{xuxemonId}/deactivate', [xuxemonController::class, 'desactivarXuxemon']);
    Route::put('/xuxemons/{xuxemonId}/activate', [xuxemonController::class, 'activarXuxemon']);

    //Chuches
    Route::post('/give_chuche/{xuxemonId}/{candyAmount}', [enfermedadesController::class, 'giveCandy']);
    Route::post('/infeccion/{xuxemonId}', [enfermedadesController::class, 'aplicarInfeccion']);
    Route::post('/evolucion/{xuxemonId}', [enfermedadesController::class, 'aplicarEvolucion']);
    Route::get('/random_chuche', [inventarioController::class, 'randomChuche']);
    
    //Inventario
    Route::get('/inventario', [InventarioController::class, 'index']);
    Route::post('/add-daily-chuches', [DailyChuches::class, 'addDailyChuches']);
    
    //Hospital
    Route::post('/usarCura/{xuxemonId}/{objeto}', [enfermedadesController::class, 'usarCura']);
    Route::get('/hospital', [enfermedadesController::class, 'xuxemonsConEnfermedad']);
    
    //Amigos
    Route::get('/amigos', [amigosController::class, 'index']);
    Route::post('/amigos', [amigosController::class, 'store']);
    Route::delete('/amigos', [amigosController::class, 'destroy']);
    Route::post('/amigos/aceptar/{userTag}', [amigosController::class, 'aceptarSolicitud']);
    Route::post('/amigos/rechazar/{userTag}', [amigosController::class, 'rechazarSolicitud']);
    Route::get('/buscar-usuarios', [amigosController::class, 'buscarUsuarios']);
    Route::get('/amigos/pendientes', [amigosController::class, 'solicitudesPendientes']);
    
    //Chat
    Route::get('/chat/{userTag}', [ChatController::class, 'index']);
    Route::post('/mensaje/{userTag}', [ChatController::class, 'enviarMensaje']);
    Route::delete('/borrarChat', [ChatController::class, 'destroy']);

    //Intercambios
    Route::get('/intercambios', [IntercambioXuxemons::class, 'index']);
    Route::post('/intercambios', [IntercambioXuxemons::class, 'store']);
    Route::get('/intercambios/pendientes', [IntercambioXuxemons::class, 'solicitudesIntercambioPendientes']);
    Route::post('/intercambios/aceptar/{userTag}', [IntercambioXuxemons::class, 'aceptarSolicitud']);
    Route::post('/intercambios/rechazar/{userTag}', [IntercambioXuxemons::class, 'rechazarSolicitud']);


    // Rutas para el administrador
    Route::middleware(['role'])->group(function () {
        Route::post('/xuxemons/crearXuxemon', [xuxemonController::class, 'store']);
        Route::put('/xuxemons/{id}', [xuxemonController::class, 'update']);
        Route::delete('/xuxemons/{id}', [xuxemonController::class, 'destroy']);
        Route::get('/xuxemons', [xuxemonController::class, 'xuxemonAll']);
        Route::get('/randomXuxemonAdmin', [xuxemonController::class, 'randomXuxemonAdmin']);
        Route::get('/random_chucheAdmin', [inventarioController::class, 'randomChucheAdmin']);
        Route::get('/configurations', [EvoConfigController::class, 'index']);
        Route::put('/configurations/{nivel}/{chuches}', [EvoConfigController::class, 'update']);
        Route::get('/inventarioAdmin', [InventarioController::class, 'showInventory']);
        Route::put('/configurations/chuches-diarias', [EvoConfigController::class, 'updateDailyChuches']);
        Route::put('/enfermedades/configuracion/', [enfermedadesController::class, 'update']);
        Route::put('/enfermedades/confBajon', [enfermedadesController::class, 'updateXuxesBajon']);
    });
});