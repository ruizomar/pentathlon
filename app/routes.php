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

/*
Route::get('/ejemplo', function()
{
	return View::make('registro.ejemplo');
});
*/


Route::get('recluta/alta','AltaReclutaController@get_nuevo');
Route::post('recluta/alta','AltaReclutaController@post_nuevo');
Route::get('recluta/editar','EditaReclutaController@editar');
Route::get('recluta/prueba','EditaReclutaController@prueba');
Route::get('recluta/otro','EditaReclutaController@otro');
Route::post('recluta/buscar','EditaReclutaController@buscar');
Route::get('recluta/lista','AltaReclutaController@lista');

Route::post('buscar','BuscarController@buscar');
Route::controller('pagos', 'MembresiasController');
Route::controller('companias','CompaniasController');
Route::controller('asistencias','AsistenciasController');
Route::controller('condecoraciones','CondecoracionesController');
Route::controller('eventos','EventosController');
Route::controller('examenes','ExamenesController');