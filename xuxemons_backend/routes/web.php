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
*/

Route::get('/', function () {
    return view('register');
});

//RegisterController
Route::post('/users', [RegisterController::class, 'store'])->name('users.store');//formulario register
Route::get('/index', [RegisterController::class, 'index'])->name('users.index');//redigiri a la pagina login
Route::post('/logiin', [LoginController::class, 'login'])->name('login');//redigiri a la pagina login

Route::get('/xuxemons', [xuxemonController::class, 'index'])->name('xuxemons.index');


Route::resource('xuxemons', xuxemonController::class);


Route::get('/xuxemons/random', [xuxemonController::class, 'randomXuxemon'])->name('xuxemons.random');
