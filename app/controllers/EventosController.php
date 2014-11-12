<?php 
class EventosController extends BaseController{

	public function getIndex(){
		$tipos = array();
		foreach (Tipoevento::all() as $tipo) {
			$tipos[$tipo->id] = $tipo->nombre;
		}
		return View::make('administracion/eventos')
			->with('eventos',Evento::where('fecha','>',date('Y-m-d'))
			->orderBy('fecha','asc')
			->get())->with('tipos',$tipos);
	}

	public function postNuevoevento(){
		$rules = array(
			'Nombre' 	=> 'required',
			'Fecha' 	=> 'required',
			'Tipo' 		=> 'required',
			'Lugar' 	=> 'required',
			'Precio' 	=> 'required|integer'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}

		$evento = Evento::where('nombre','=',Input::get('Nombre'),'and')
						->where('fecha','=',Input::get('Fecha'))->first();
		if (is_null($evento)) {
			$evento = Evento::create(array(
				'nombre' 		=> Input::get('Nombre'),
				'lugar' 		=> Input::get('Lugar'),
				'fecha' 		=> Input::get('Fecha'),
				'descripcion' 	=> Input::get('Descripcion'),
				'precio' 		=> Input::get('Precio'),
				'tipoevento_id' => Input::get('Tipo')
			));
			$dato = array('success'		=>	true,
						  'message'		=>	'Evento creado',
						  'evento'		=>	$evento
							);
		}
		else{
			$dato = array('success'		=>	false,
						'errormessage'	=>	'Ya existe un evento con el mismo nombre y fecha');
		}

		return Response::json($dato);		
	}

	public function getInscripciones(){
		$tipos = array();
		foreach (Tipoevento::all() as $tipo) {
			$tipos[$tipo->id] = $tipo->nombre;
		}
		return View::make('administracion/inscripciones')
			->with('eventos',Evento::where('fecha','>',date('Y-m-d'))
			->orderBy('fecha','asc')
			->get())->with('tipos',$tipos);
	}
	public function postEventos(){
		return Response::json(
			Evento::where('fecha','>=',date('Y-m-d'))
			->orderBy('fecha','asc')
			->get()
		);
	}
}