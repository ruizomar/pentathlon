<?php 
class CuerposController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
    }
	public function getIndex(){
		return View::make('cuerpos/cuerpos')->with('cuerpos',Tipocuerpo::all());
	}

	public function postNuevo(){
		$rules = array(
			'nombre' 	=> 'required',
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}
		if(is_null(Tipocuerpo::where('nombre','=',Input::get('nombre'))->first()) ){
			$cuerpo 			= 	new Tipocuerpo;
			$cuerpo->nombre 	= 	Input::get('nombre');
			$cuerpo->save();

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
		$cuerpo = Tipocuerpo::where('nombre','=',Input::get('nombre'))->first();
		if(!is_null($cuerpo) )
			if($cuerpo->id != Input::get('id'))
					return Redirect::back()->with('status', 'ocupado');

			$cuerpo = Tipocuerpo::find(Input::get('id'));
			$cuerpo->update(array(
				'nombre' 	=> Input::get('nombre'),
				));
		return Redirect::back()->with('status', 'ok_create');
	}
}