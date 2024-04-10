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
*/
Route::middleware(['cors'])->group(function () {
    // Crear usuario
    Route::post('/userRegister', [RegisterController::class, 'store']);

    // Login
    Route::post('/userLogin', [LoginController::class, 'login']);

<<<<<<< Updated upstream
    // Gestionar xuxemons
    // Rutas para xuxemons
  // Route::middleware(['role'])->group(function () {
        Route::get('/xuxemons/user/{id}', [xuxemonController::class, 'index']);
        Route::post('/xuxemons/user/{id}', [xuxemonController::class, 'store']);
        Route::get('/xuxemons/{id}', [xuxemonController::class, 'show']);
        Route::put('/xuxemons/{id}', [xuxemonController::class, 'update']);
        Route::delete('/xuxemons/{id}', [xuxemonController::class, 'destroy']);
=======
//-----------Gestion usuario----------------
    Route::get('/xuxemons/user', [xuxemonController::class, 'index']); //mostrar los xuxemons de ese usuario
    Route::get('/xuxemons/verXuxemon', [xuxemonController::class, 'show']); //mostrar ese xuxemon especifico
    Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']); //random para usuario
    Route::get('/give_chuche/{xuxemonId}/{candyAmount}', [xuxemonController::class, 'giveCandy']); //dar xuxe a xuxemon
>>>>>>> Stashed changes

//-----------Gestion Administrador----------------
   Route::middleware(['role'])->group(function () {
        Route::post('/xuxemons/crearXuxemon', [xuxemonController::class, 'store']);//crear xuxemon
        Route::put('/xuxemons/update', [xuxemonController::class, 'update']); //actualizar xuxemon
        Route::delete('/xuxemons/delete', [xuxemonController::class, 'destroy']); //Admin
        Route::get('/xuxemons', [xuxemonController::class, 'xuxemonAll']); //ver todos los xuxemons

     
        Route::get('/randomXuxemonAdmin', [xuxemonController::class, 'randomXuxemonAdmin']); //crear random Administrador
        Route::get('/random_chucheAdmin', [inventarioController::class, 'randomChucheAdmin']);
        Route::get('/configurations', [EvoConfigController::class, 'index']); //ver la configuracion 
        Route::put('/configurations/{id}', [EvoConfigController::class, 'update']); //cambiar configuracion
        Route::get('/inventario', [InventarioController::class, 'index']);
  });
});