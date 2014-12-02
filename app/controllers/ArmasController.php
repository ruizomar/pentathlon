<?php 
class ArmasController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
    }
	public function getIndex(){
		return View::make('armas/armas')->with('armas',Tipoarma::all());
	}

	public function postNueva(){
		$rules = array(
			'nombre' 	=> 'required',
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}
		if(is_null(Tipoarma::where('nombre','=',Input::get('nombre'))->first()) ){
			$arma = new Tipoarma;
				$arma->nombre 	= Input::get('nombre');
			$arma->save();

			return Redirect::back()->with('status', 'ok_create');
		}
		else
			return Redirect::back()->with('status', 'ocupado');
	}
	public function postUpdate(){
		$rules = array(
			'nombre' 	=>	'required',
			'id'		=>	'integer|required'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}
		$arma = Tipoarma::where('nombre','=',Input::get('nombre'))->first();
		if(!is_null($arma) )
			if($arma->id != Input::get('id'))
					return Redirect::back()->with('status', 'ocupado');

			$arma = Tipoarma::find(Input::get('id'));
			$arma->update(array(
				'nombre' 	=> Input::get('nombre'),
				));
		return Redirect::back()->with('status', 'ok_create');
	}
}