<?php

use Illuminate\Support\Facades\Route;

/*
ESTRUCTURA DE RESPUESTA
json
(
	'status' => 200,
	'response' => 'All ok!',
	'error' => 'Nothing',
	'data' => 'ok, all right!!',
	'ok' => true
);
*/

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('token',function(){ return csrf_field(); });

Route::get('api/user/token','UserController@token');

Route::group(['prefix'=>'api'],function()
{
	Route::resource('user','UserController');
	Route::resource('bank','BankController');
	Route::resource('quote', 'QuoteController');
	Route::resource('category', 'CategoryController');
});