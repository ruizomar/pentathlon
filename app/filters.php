<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('inicio');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
Route::filter('admin',function(){
    if(is_null(User::find(Auth::id())->roles()->where('id','=',1)->first()))
    	 return "No eres Administrador";
});
Route::filter('hacienda',function(){
    if(is_null(User::find(Auth::id())->roles()->where('id','=',2)->first()))
    	 return "No eres de Hacienda";
});
Route::filter('tecnica',function(){
    if(is_null(User::find(Auth::id())->roles()->where('id','=',3)->first()))
    	 return "No eres de Seccion Tecnica";
});
Route::filter('militar',function(){
    if (is_null(User::find(Auth::id())->roles()->where('id','=',4)->first()))
    	 return "No eres de Seccion Militar";
});
Route::filter('archivo',function(){
    if (is_null(User::find(Auth::id())->roles()->where('id','=',5)->first()))
    	 return "No eres de Seccion Deporiva";
});
Route::filter('investigacion',function(){
    if (is_null(User::find(Auth::id())->roles()->where('id','=',6)->first()))
    	 return "No eres de Seccion de Investigacion";
});
Route::filter('comandante',function(){
    if (is_null(User::find(Auth::id())->roles()->where('id','=',7)->first()))
    	 return "No eres de Seccion Organizacion";
});
Route::filter('instructor',function(){
    if (is_null(User::find(Auth::id())->roles()->where('id','=',8)->first()))
    	 return "No eres de Instructor";
});
