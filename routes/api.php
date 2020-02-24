<?php

use Illuminate\Http\Request;

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


//listar clientes
Route::get('/clientes', 'ClienteController@index');
//listar contas
Route::get('/contas', 'ContaController@index');
//uma conta
Route::get('/contas/{id}', 'ContaController@conta');
//fazer depósito
Route::put('/deposito/{id}', 'ContaController@deposito');
//fazer saque
Route::put('/saque/{id}', 'ContaController@saque');
