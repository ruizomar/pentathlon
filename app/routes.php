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

Route::get('login', array('before' => 'guest', function()
{
	return View::make('login/login');
}));


Route::get('/', array('before' => 'auth', function()
{
	return View::make('layaouts/base');
}));



Route::get('recluta/alta','AltaReclutaController@get_nuevo');
Route::post('recluta/curp','AltaReclutaController@errorCurp');
Route::post('recluta/alta','AltaReclutaController@post_nuevo');

Route::get('recluta/editar','EditaReclutaController@editar');
Route::post('recluta/buscar','EditaReclutaController@buscar');
Route::post('recluta/update','EditaReclutaController@update');

Route::controller('cargos', 'AsignaCargosController');
Route::controller('ascensos', 'AsignaAscensosController');

Route::post('buscar','BuscarController@buscar');
Route::controller('pagos', 'MembresiasController');
Route::controller('companias','CompaniasController');
Route::controller('asistencias','AsistenciasController');
Route::controller('condecoraciones','CondecoracionesController');
Route::controller('eventos','EventosController');
Route::controller('examenes','ExamenesController');

Route::get('registrar', function()
{

	$user = new User;
	$user->role_id = 2;
	$user->elemento_id = 1;
	$user->username = "hacienda";
    $user->password = Hash::make('123');
	// guardamos
	$user->save();
	return "El usuario fue agregado.";
});
Route::post('login', 'UserLogin@user');
Route::get('logout', 'UserLogin@logOut');

Route::get('forgot','RecoverPassword@getForgotpassword');
Route::post('forgot','RecoverPassword@postForgotpassword');
Route::get('recover/{token?}','RecoverPassword@getRecover');
Route::post('recover','RecoverPassword@postRecover');









Route::get('email',function(){
	Mail::send('emails.auth.reminder', array('name'=>'omarr'), function($message){
		$message->to('omar.ruiz.mz@gmail.com','omar ruiz')->subject('test');
	});
});