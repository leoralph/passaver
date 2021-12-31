<?php

use App\Http\Controllers\Passaver\AdminController;
use App\Http\Controllers\Passaver\AuthController;
use App\Http\Controllers\Passaver\ContaController;
use App\Http\Controllers\Passaver\CryptController;
use App\Http\Controllers\Passaver\HomeController;
use App\Http\Controllers\Passaver\UsuarioController;
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

    Route::get('/teste', [CryptController::class, 'teste']);

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar'])->name('autenticar');
    Route::get('/cadastrar', [UsuarioController::class, 'cadastrarUsuario'])->name('usuario.cadastrar');
    Route::post('/cadastrar', [UsuarioController::class, 'salvarCadastro'])->name('usuario.salvar-cadastro');

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::group(['as' => 'verification.'], function(){
            Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificarEmail'])->middleware(['signed'])->name('verify');
            Route::get('/nao-verificado', [AuthController::class, 'naoVerificado'])->name('notice');
            Route::get('/reenviar-verificacao', [AuthController::class, 'enviarVerificacao'])->middleware(['throttle:6,1'])->name('send');
        });
        
        Route::group(['middleware' => 'verified'], function(){
            Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['verified', 'auth']);

            Route::group(['as' => 'conta.', 'prefix' => '/conta'], function(){
                Route::get('/{id}/excluir', [ContaController::class, 'excluirConta'])->name('excluir');
                Route::get('/cadastrar', [ContaController::class, 'modalCadastrar'])->name('cadastrar');
                Route::post('/salvar', [ContaController::class, 'salvar'])->name('salvar');
                Route::get('/consultar/{id}', [ContaController::class, 'modalConsultar'])->name('consultar');
                Route::post('/atualizar', [ContaController::class, 'atualizar'])->name('atualizar');
            });
            
            Route::group(['as' => 'usuario.'], function(){
                Route::get('/perfil', [CryptController::class, 'teste'])->name('perfil');
            });

            Route::group(['as' => 'admin.', 'middleware' => 'admin', 'prefix' => '/admin'], function(){
                Route::get('/painel', [AdminController::class, 'index'])->name('painel');
                Route::post('/recriptografar-senha', [AdminController::class, 'recriptografarSenhas'])->name('recriptografar-senha');
            });

        });
    });
});
