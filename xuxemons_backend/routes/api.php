<?php

use App\Http\Controllers\EvoConfigController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\xuxemonController;
use App\Http\Controllers\inventarioController;



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
    // Crear usuario
    Route::post('/userRegister', [RegisterController::class, 'store']);

    // Login
    Route::post('/userLogin', [LoginController::class, 'login']);

//-----------Gestion usuario----------------
    Route::get('/xuxemons/user', [xuxemonController::class, 'index']); //mostrar los xuxemons de ese usuario
    Route::get('/xuxemons/verXuxemon', [xuxemonController::class, 'show']); //mostrar ese xuxemon especifico
    Route::get('/random_xuxemon', [xuxemonController::class, 'randomXuxemon']); //random para usuario
    Route::get('/give_chuche/{xuxemonId}/{candyAmount}', [xuxemonController::class, 'giveCandy']); //dar xuxe a xuxemon

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