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

Route::get('login', array('before' => 'guest', function(){
	return View::make('login/login');
}));
Route::get('/', function(){
	// return View::make('hello');
	return View::make('hello');
});
Route::get('inicio', array('before' => 'auth', function(){
	return View::make('inicio');
}));
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
Route::post('recluta/status','EditaReclutaController@status');

/*Route::get('cargos/editar','AsignaCargosController@editar');
Route::post('cargos/buscar','AsignaCargosController@buscar');
Route::post('cargos/update','AsignaCargosController@update');*/

Route::controller('cargos', 'AsignaCargosController');
Route::controller('ascensos', 'AsignaAscensosController');
Route::controller('jura', 'JuraBanderaController');
Route::controller('reportes', 'ReportesController');
Route::controller('concursos', 'ConcursosController');
Route::controller('elementos', 'ElementosController');


Route::post('buscar','BuscarController@buscar');
Route::controller('buscar', 'BuscarController');
Route::controller('pagos', 'MembresiasController');
Route::controller('companias','CompaniasController');
Route::controller('asistencias','AsistenciasController');
Route::controller('condecoraciones','CondecoracionesController');

Route::controller('eventos','EventosController');
Route::controller('examenes','ExamenesController');
Route::controller('arrestos','ArrestosController');
Route::controller('armas','ArmasController');
Route::controller('cuerpos','CuerposController');
Route::controller('historial','HistorialController');

Route::post('login', 'UserLogin@user');
Route::get('logout', 'UserLogin@logOut');

Route::get('forgot','RecoverPassword@getForgotpassword');
Route::post('forgot','RecoverPassword@postForgotpassword');
Route::get('recover/{token?}','RecoverPassword@getRecover');
Route::post('recover','RecoverPassword@postRecover');
Route::controller('settings','settingsController');
Route::controller('administrador','AdminController');
Route::controller('credenciales','CredencialesController');
