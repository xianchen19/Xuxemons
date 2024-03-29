<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController as ControllersRegisterController;
use App\Http\Controllers\xuxemonController;



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

//crear usuario register
Route::post('/userRegister', [ControllersRegisterController::class, 'store']);

//login
Route::post('/userLogin', [LoginController::class, 'login']);


//gestionar xuxemons
// Rutas para xuxemons
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
