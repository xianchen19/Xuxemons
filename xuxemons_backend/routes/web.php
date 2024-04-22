<?php

use App\Http\Controllers\enfermedadesController;

use App\Http\Controllers\EvoConfigController;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\xuxemonController;
use App\Http\Controllers\inventarioController;




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
    Route::post('/userRegister', [RegisterController::class, 'store']);
    Route::post('/userLogin', [LoginController::class, 'login']);
    Route::get('/xuxemons/user', [xuxemonController::class, 'index']);
    Route::get('/xuxemons/verXuxemon', [xuxemonController::class, 'show']);
    Route::get('/users/coleccion', [xuxemonController::class, 'coleccion']);
    Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']);
    Route::get('/give_chuche/{xuxemonId}/{candyAmount}', [xuxemonController::class, 'giveCandy']);
    Route::put('/xuxemons/{xuxemonId}/activate', [xuxemonController::class, 'activarXuxemon']);
    Route::get('/random_chuche', [inventarioController::class, 'randomChuche']);
    Route::put('/xuxemons/{xuxemonId}/deactivate', [xuxemonController::class, 'desactivarXuxemon']);
    Route::get('/inventario', [InventarioController::class, 'index']);
    Route::post('/add-daily-chuches', [EvoConfigController::class, 'addDailyChuches']);

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

        Route::put('/enfermedades/configuracion', [enfermedadesController::class, 'update']);


        Route::put('/configurations/updateChuchesDiarias/{id}', [EvoConfigController::class, 'updateChuchesDiarias']);
    });
});
