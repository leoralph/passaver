<?php

use App\Http\Controllers\Passaver\AuthController;
use App\Http\Controllers\Passaver\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar'])->name('autenticar');

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['verified', 'auth']);

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificarEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

    Route::get('/nao-verificado', [AuthController::class, 'naoVerificado'])->name('verification.notice');

    Route::get('/reenviar-verificacao', [AuthController::class, 'enviarVerificacao'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});
