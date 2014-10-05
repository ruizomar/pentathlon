<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('alta', function()
{
	return View::make('registro/alta');
});


Route::controller('pagos', 'MembresiasController');
/*Route::get('pagos', function(){
	return View::make('pagos/index');
});
Route::post('elemento', 'MembresiasController@buscar');
Route::post('registrarpago', 'MembresiasController@registrarpago');
Route::post('recibo','MembresiasController@imprecion');*/

Route::get('companias', function()
{
	return View::make('administracion/companias');
});