<?php

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

Route::group(['prefix' => '/v1'], function () {
    Route::post('/login', 'ApiController@login');

    Route::group(['middleware' => 'jwt'], function(){
        Route::get('/contas', 'ApiController@listarContas');
        Route::get('/contas/{id}', 'ApiController@conta');
    });
});
