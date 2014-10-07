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
Route::controller('companias','CompaniasController');


Route::get('recluta/alta','AltaReclutaController@get_nuevo');
Route::post('recluta/alta','AltaReclutaController@post_nuevo');
Route::get('recluta/lista','AltaReclutaController@lista');
Route::get('recluta/editar','EditaReclutaController@editar');
Route::post('recluta/editar','EditaReclutaController@buscar');
