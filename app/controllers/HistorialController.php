<?php 
class HistorialController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('id','=',3)->first()))
    	 		return Redirect::to('historial/me');
        }, array('except' =>array('getMe')));
    }
	public function getIndex(){
		return View::make('historial/history');
	}
	public function getMe(){
		return View::make('historial/historial')->with('elemento',Elemento::find(Auth::user()->elemento_id));
	}

	public function postElemento(){
		return View::make('historial/historial')
		->with('elemento',Elemento::find(Input::get('id')));
	}
}