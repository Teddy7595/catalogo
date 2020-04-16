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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'view'],function ()
{
	//RUTAS QUE SOLO DEBEN RETORNAR VISTAS
});

Route::group(['prefix'=>'api'],function ()
{
	//RUTAS QUE SOLO DEBEN RETORNAR INFORMACION DEL BACKEND Y CONSUMO DE API'S
	/*
	Route::get('users/{id}','UserController@get');
	Route::put('users/{id}','UserController@put');
	Route::post('users','UserController@post');
	Route::delete('users/{id}','UserController@delete');
	*/

	Route::get('/horario',function()
	{
		date_time('d-m-Y H:i:s');
	});
	Route::get('token','UserController@token');

	Route::resource('users','UserController'); //comprodabo
	Route::resource('products', 'ProductsController'); //comprobado
	Route::resource('category', 'CategoryController'); //comprobado
	Route::resource('quotes', 'QuoteController'); //comprobado
	Route::resource('bank', 'BanksController');
	Route::resource('client', 'ClientsController');
});