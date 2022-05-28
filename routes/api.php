<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\\', 'prefix' => '/v1'], function(){

    Route::post('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout');
    Route::get('/usuario', 'UsuarioController@show');
    Route::post('/usuario', 'UsuarioController@store');

    Route::group(['middleware' => 'auth:sanctum'], function(){

        Route::prefix('/conta')->group(function(){
            Route::get('/', 'ContaController@index');
            Route::get('/{id}', 'ContaController@show');
            Route::post('/', 'ContaController@store');
            Route::patch('/{id}', 'ContaController@update');
            Route::delete('/{id}', 'ContaController@destroy');
        });

        Route::get('/senha', 'SenhaController@show');

    });

});