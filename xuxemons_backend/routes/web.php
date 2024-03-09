<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\xuxemonController;


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
    //Route::middleware(['role:administrador'])->group(function () {
        Route::get('/xuxemons', [xuxemonController::class, 'index']);
        Route::post('/xuxemons', [xuxemonController::class, 'store']);
        Route::get('/xuxemons/{id}', [xuxemonController::class, 'show']);
        Route::put('/xuxemons/{id}', [xuxemonController::class, 'update']);
        Route::delete('/xuxemons/{id}', [xuxemonController::class, 'destroy']);

        // Ruta para editar xuxemons
        Route::get('/xuxemons/{id}/edit', [xuxemonController::class, 'edit']);

        // Ruta para crear xuxemons
        Route::get('/xuxemons/create', [xuxemonController::class, 'create']);

        // Ruta para generar xuxemon aleatorio
        Route::get('/generar-xuxemon-aleatorio', [xuxemonController::class, 'randomXuxemon']);
   // });
});