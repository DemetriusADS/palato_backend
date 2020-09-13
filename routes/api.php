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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Auth\LoginController@login');

Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum', 'role:administrador||financeiro']], function () {
    Route::get('/', 'Api\UserController@list');
    Route::post('/', 'Api\UserController@create');
    Route::put('/{id}', 'Api\UserController@update');
    Route::delete('/{id}', 'Api\UserController@delete');
});

Route::group(['prefix' => 'picole', 'middleware' => ['auth:sanctum']], function () {
    Route::post('/', ['uses' => 'Api\PicoleController@create', 'middleware' => ['role:administrador||financeiro']]);
    Route::get('/', ['uses' => 'Api\PicoleController@list']);
    Route::put('/{id}', 'Api\PicoleController@update');
    Route::delete('/{id}', ['uses' => 'Api\PicoleController@delete', 'middleware' => ['role:administrador||financeiro']]);
});

Route::group(['prefix' => 'lote', 'middleware' => ['auth:sanctum']], function () {
    Route::post('/', ['uses' => 'Api\LoteController@create', 'middleware' => ['role:administrador||financeiro||producao']]);
    Route::get('/', ['uses' => 'Api\LoteController@list']);
    Route::put('/{id}', 'Api\LoteController@update');
    Route::delete('/{id}', ['uses' => 'Api\LoteController@delete', 'middleware' => ['role:administrador||financeiro||producao']]);
});

Route::group(['prefix' => 'venda', 'middleware' => ['auth:sanctum']], function () {
    Route::post('/', ['uses' => 'Api\VendaController@create', 'middleware' => ['role:administrador||financeiro||vendedor']]);
    Route::get('/', ['uses' => 'Api\VendaController@list']);
    Route::put('/{id}', 'Api\VendaController@update');
    Route::delete('/{id}', ['uses' => 'Api\VendaController@delete', 'middleware' => ['role:administrador||financeiro||producao']]);
});

Route::group(['prefix' => 'pedido', 'middleware' => ['auth:sanctum']], function () {
    Route::post('/', ['uses' => 'Api\PedidoController@create', 'middleware' => ['role:administrador||financeiro||vendedor']]);
    Route::get('/', ['uses' => 'Api\PedidoController@list']);
    Route::put('/{id}', 'Api\PedidoController@update');
    Route::delete('/{id}', ['uses' => 'Api\PedidoController@delete', 'middleware' => ['role:administrador||financeiro||vendedor']]);
});
