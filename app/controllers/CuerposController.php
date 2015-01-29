<?php 
class CuerposController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin');
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
		  return Response::json(array('success' => false));
		}
		if(is_null(Tipocuerpo::where('nombre','=',Input::get('nombre'))->first()) ){
			$cuerpo 			= 	new Tipocuerpo;
			$cuerpo->nombre 	= 	Input::get('nombre');
			$cuerpo->save();

			return Response::json(array('success' => true));
		}
		else
			return Response::json(array('ocupado' => true));
	}
	public function postUpdate(){
		$rules = array(
			'nombre' 	=>	'required',
			'id'		=>	'integer|required'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Response::json(array('success' => false));
		}
		$cuerpo = Tipocuerpo::where('nombre','=',Input::get('nombre'))->first();
		if(!is_null($cuerpo) )
			if($cuerpo->id != Input::get('id'))
					return Response::json(array('ocupado' => true));

			$cuerpo = Tipocuerpo::find(Input::get('id'));
			$cuerpo->update(array(
				'nombre' 	=> Input::get('nombre'),
				));
		return Response::json(array('success' => true));
	}
}