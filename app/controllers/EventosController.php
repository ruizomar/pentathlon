<?php 
class EventosController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin', array('except' => 'postEventos'));
    }
	public function getIndex(){
		$tipos = array();
		foreach (Tipoevento::all() as $tipo) {
			$tipos[$tipo->id] = $tipo->nombre;
		}
		return View::make('eventos/eventos')
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

	public function postEventos(){
		return Response::json(
			Evento::where('fecha','>=',date('Y-m-d'),'and')
			->where('precio','>',0)
			->orderBy('fecha','asc')
			->get()
		);
	}

	public function postEvento(){
		$rules = array(
			'id'		=> 'required|integer'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		return Response::json(Evento::find(Input::get('id')));
	}
	public function postUpdate(){
		$rules = array(
			'Nombre' 	=> 'required',
			'Fecha' 	=> 'required',
			'Tipo' 		=> 'required',
			'Lugar' 	=> 'required',
			'Precio' 	=> 'required|integer',
			'id'		=> 'required|integer'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		$evento = Evento::where('nombre','=',Input::get('Nombre'),'and')
						->where('fecha','=',Input::get('Fecha'))->first();
		if (is_null($evento) || $evento->id == Input::get('id')) {
			$evento = Evento::find(Input::get('id'));
			$evento->update(array(
				'nombre' 		=> Input::get('Nombre'),
				'lugar' 		=> Input::get('Lugar'),
				'fecha' 		=> Input::get('Fecha'),
				'descripcion' 	=> Input::get('Descripcion'),
				'precio' 		=> Input::get('Precio'),
				'tipoevento_id' => Input::get('Tipo')
				));
			$dato = array('success'		=>	true,
						  'message'		=>	'Evento actualizado',
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
		return View::make('eventos/inscripciones')
			->with('eventos',Evento::where('fecha','>',date('Y-m-d'),'and')
				->where('precio','=',0)
				->orderBy('fecha','asc')
				->get())
			->with('tipos',$tipos);
	}
	public function postInscritos(){
		$rules = array(
			'id'		=> 'required|integer|exists:eventos'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		$elementos = Elemento::all();
		$elementosinscritos = array();
		$elementosnoinscritos = array();
		foreach ($elementos as $elemento) {
			if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') {
				if(is_null($elemento->eventos()->where('id','=',Input::get('id'))->first())){
					$numatricula = 'Sin asignar';
					if(!is_null($elemento->matricula))
						$numatricula = $elemento->matricula->id;
					$elementosnoinscritos[] = array(
						$elemento->id,
						$numatricula,
						$elemento->persona->nombre." ".$elemento->persona->apellidopaterno." ".$elemento->persona->apellidomaterno,
						$elemento->companiasysubzona->tipo." ".$elemento->companiasysubzona->nombre
						);
				}
				else{
					$numatricula = 'Sin asignar';
					if(!is_null($elemento->matricula))
						$numatricula = $elemento->matricula->id;
					$elementosinscritos[] = array(
						$elemento->id,
						$numatricula,
						$elemento->persona->nombre." ".$elemento->persona->apellidopaterno." ".$elemento->persona->apellidomaterno,
						$elemento->companiasysubzona->tipo." ".$elemento->companiasysubzona->nombre
						);
				}
			}
		}
		$dato = array('success'	=>	true,
					  'elementosinscritos'		=> $elementosinscritos,
					  'elementosnoinscritos'	=> $elementosnoinscritos);
		return Response::json($dato);
	}

	public function postInscribir(){
		$rules = array(
			'id'		=> 'required|integer|exists:eventos'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		foreach (Input::all() as $key => $value) {
			if(is_numeric($key)){
				$elemento = Elemento::find($key);
				$elemento->eventos()->attach(Input::get('id'));
			}
		}
		$dato = array('success'	=>	true,);
		return Response::json($dato);
	}
	public function postDesinscribir(){
		$rules = array(
			'id'		=> 'required|integer|exists:eventos'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails()){
			$dato = array('success'=>false,
					'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		foreach (Input::all() as $key => $value) {
			if(is_numeric($key)){
				$elemento = Elemento::find($key);
				$elemento->eventos()->detach(Input::get('id'));
			}
		}
		$dato = array('success'	=>	true,);
		return Response::json($dato);
	}
}