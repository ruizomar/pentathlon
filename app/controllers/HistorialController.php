<?php 
class HistorialController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('nombre','=','archivo')->first()) && is_null(User::find(Auth::id())->roles()->where('nombre','=','tecnica')->first()))
    	 		return Redirect::to('historial/me');
        }, array('except' =>array('getMe','getElemento','getHistorial')));

        $this->beforeFilter(function(){
        	if(is_null(User::find(Auth::id())->roles()->where('nombre','=','archivo')->first()) && is_null(User::find(Auth::id())->roles()->where('nombre','=','tecnica')->first()))
			    if( Auth::user()->elemento_id != Request::segment(3))
	    	 		return Redirect::to('inicio');
        }, array('only' =>array('getHistorial')));

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

	public function getHistorial($id){
		$html =  View::make('historial/imprimir')->with('elemento',Elemento::find($id));
        $pdf = App::make('dompdf');
        $pdf->loadHTML($html);
        return $pdf->stream();
	}
}