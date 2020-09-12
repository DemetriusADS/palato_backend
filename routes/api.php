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
