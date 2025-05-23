<?php 

use Illuminate\Support\Facades\Route;

    
Route::group(['as' => 'verification.'], function(){
    Route::get('/email/verify/{id}/{hash}', 'AuthController@verificarEmail')->middleware(['signed'])->name('verify');
    Route::get('/nao-verificado', 'AuthController@naoVerificado')->name('notice');
    Route::get('/reenviar-verificacao', 'AuthController@enviarVerificacao')->middleware(['throttle:6,1'])->name('send');
});

Route::group(['as' => 'passaver.'], function(){

    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@autenticar')->name('autenticar');
    Route::get('/cadastrar', 'UsuarioController@cadastrarUsuario')->name('usuario.cadastrar');
    Route::post('/cadastrar', 'UsuarioController@salvarCadastro')->name('usuario.salvar-cadastro');

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/logout', 'AuthController@logout')->name('logout');

        
        Route::group(['middleware' => 'verified'], function(){
            Route::get('/', 'HomeController@index')->name('home')->middleware(['verified', 'auth']);
            Route::get('/excluir', 'ExclusaoController@modal')->name('excluir-item');
            Route::delete('/excluir', 'ExclusaoController@confirmarExclusao')->name('confirmar-exclusao');

            Route::group(['as' => 'conta.', 'prefix' => '/conta'], function(){
                Route::get('/modal/{id?}', 'ContaController@modal')->name('modal');
                Route::post('/salvar', 'ContaController@salvar')->name('salvar');
            });

            Route::group(['as' => 'senha.', 'prefix' => '/senha'], function(){
                Route::get('/gerar', 'SenhaController@gerar')->name('gerar');
            });
            
            Route::group(['as' => 'usuario.'], function(){
                Route::get('/perfil', 'UsuarioController@perfil')->name('perfil');
            });

            Route::group(['as' => 'arquivo.', 'prefix' => '/arquivo'], function(){
                Route::get('/', 'ArquivoController@index')->name('listar');
                Route::get('/modal', 'ArquivoController@modal')->name('modal');
                Route::get('/download/{referencia}', 'ArquivoController@download')->name('download');
                Route::post('/salvar', 'ArquivoController@salvarArquivo')->name('salvar');
                Route::get('/excluir/{id}', 'ArquivoController@excluirArquivo')->name('excluir');
            });

        });
    });
});
