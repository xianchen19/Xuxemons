<?php

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
*/Route::middleware(['cors'])->group(function () {
    // Crear usuario
    Route::post('/userRegister', [RegisterController::class, 'store']);

    // Login
    Route::post('/userLogin', [LoginController::class, 'login']);

    // Gestionar xuxemons
    // Rutas para xuxemons
  // Route::middleware(['role'])->group(function () {
        Route::get('/xuxemons/user/{id}', [xuxemonController::class, 'index']);
        Route::post('/xuxemons/user/{id}', [xuxemonController::class, 'store']);
        Route::get('/xuxemons/{id}', [xuxemonController::class, 'show']);
        Route::put('/xuxemons/{id}', [xuxemonController::class, 'update']);
        Route::delete('/xuxemons/{id}', [xuxemonController::class, 'destroy']);
        Route::get('/xuxemons', [xuxemonController::class, 'xuxemonAll']);

        // Ruta para editar xuxemons
        Route::get('/xuxemons/{id}/edit', [xuxemonController::class, 'edit']);

        // Ruta para crear xuxemons
        Route::get('/xuxemons/create', [xuxemonController::class, 'create']);

        // Ruta para generar xuxemon aleatorio
        Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']);
        Route::get('/random_chuche', [inventarioController::class, 'randomChuche']);
        Route::get('/give_chuche/{xuxemonId}/{candyAmount}', [xuxemonController::class, 'giveCandy']);
        Route::get('/configurations', [EvoConfigController::class, 'index']);
        Route::put('/configurations/{id}', [EvoConfigController::class, 'update']);
        Route::post('/configuraciones', [EvoConfigController::class, 'create']);
        Route::get('/inventario/{id}', [InventarioController::class, 'index']);
   //  });
});