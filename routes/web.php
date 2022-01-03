<?php
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

Route::group(['namespace' => 'App\Http\Controllers\Passaver'], function(){

    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@autenticar')->name('autenticar');
    Route::get('/cadastrar', 'UsuarioController@cadastrarUsuario')->name('usuario.cadastrar');
    Route::post('/cadastrar', 'UsuarioController@salvarCadastro')->name('usuario.salvar-cadastro');

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::group(['as' => 'verification.'], function(){
            Route::get('/email/verify/{id}/{hash}', 'AuthController@verificarEmail')->middleware(['signed'])->name('verify');
            Route::get('/nao-verificado', 'AuthController@naoVerificado')->name('notice');
            Route::get('/reenviar-verificacao', 'AuthController@enviarVerificacao')->middleware(['throttle:6,1'])->name('send');
        });
        
        Route::group(['middleware' => 'verified'], function(){
            Route::get('/', 'HomeController@index')->name('home')->middleware(['verified', 'auth']);

            Route::group(['as' => 'conta.', 'prefix' => '/conta'], function(){
                Route::get('/{id}/excluir', 'ContaController@excluirConta')->name('excluir');
                Route::get('/cadastrar', 'ContaController@modalCadastrar')->name('cadastrar');
                Route::post('/salvar', 'ContaController@salvar')->name('salvar');
                Route::get('/consultar/{id}', 'ContaController@modalConsultar')->name('consultar');
                Route::post('/atualizar', 'ContaController@atualizar')->name('atualizar');
            });
            
            Route::group(['as' => 'usuario.'], function(){
                Route::get('/perfil', 'UsuarioController@perfil')->name('perfil');
            });

            Route::group(['as' => 'admin.', 'middleware' => 'admin', 'prefix' => '/admin'], function(){
                Route::get('/', 'AdminController@index')->name('index');
                Route::post('/arquivo', 'AdminController@arquivo')->name('arquivos');
            });

        });
    });
});
