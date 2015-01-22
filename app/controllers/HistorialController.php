<?php 
class HistorialController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        //$this->beforeFilter('tecnica', array('except' => 'getMe'));
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