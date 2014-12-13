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

// Route::controller('editar', 'EditaReclutaController');

Route::get('recluta/alta','AltaReclutaController@get_nuevo');
Route::post('recluta/curp','AltaReclutaController@errorCurp');
Route::post('recluta/alta','AltaReclutaController@post_nuevo');

Route::get('recluta/editar','EditaReclutaController@editar');
Route::post('recluta/buscar','EditaReclutaController@buscar');
Route::post('recluta/update','EditaReclutaController@update');
Route::get('recluta/lugares','EditaReclutaController@lugares');
Route::post('recluta/extendidos','EditaReclutaController@extendidos');
Route::post('recluta/cargos','EditaReclutaController@cargos');

/*Route::get('cargos/editar','AsignaCargosController@editar');
Route::post('cargos/buscar','AsignaCargosController@buscar');
Route::post('cargos/update','AsignaCargosController@update');*/

Route::controller('cargos', 'AsignaCargosController');
Route::controller('ascensos', 'AsignaAscensosController');
Route::controller('jura', 'JuraBanderaController');


Route::post('buscar','BuscarController@buscar');
Route::controller('pagos', 'MembresiasController');
Route::controller('companias','CompaniasController');
Route::controller('asistencias','AsistenciasController');
Route::controller('condecoraciones','CondecoracionesController');

Route::get('/22',function()
{
	return View::make('login.login');
});