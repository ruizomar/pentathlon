<?php 
class BuscarController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	public function getIndex(){
		return View::make('layaouts.busqueda');
	}

	public function buscar(){
		$rules = array(
			'nombre' => 'required',
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{
			$dato = array('success'=>false,
				'errormessage'=>'<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');

		$elemento = Elemento::whereHas('persona',function($q) use ($nombre,$paterno,$materno){ 
			$q->where('nombre','like',$nombre.'%','and')
			->where('apellidopaterno','like',$paterno.'%','and')
			->where('apellidomaterno','like',$materno.'%');
		})->get();

		if(count($elemento) == 1){
			$elemento = $elemento->first();
			if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo' || $elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Nuevo') {
				$dato = array(
					'success' => true,
					'id' => $elemento->id
				);
			}
			else
				$dato = array('success' => false,'ms' => true);
		}
		else if(count($elemento) > 1){
			$dato = array();
			foreach ($elemento as $elemento) {
				if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Nuevo' || $elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') {
					$dato[] = array(
						'id' => $elemento->id,
						'nombre' => $elemento->persona->nombre,
						'paterno' => $elemento->persona->apellidopaterno,
						'materno' => $elemento->persona->apellidomaterno,
						'fecha' => $elemento->fechanacimiento,
						'matricula' => $elemento->matricula,
						'ubicacion' => Companiasysubzona::find($elemento->companiasysubzona_id) -> nombre,
						);
				}
			}
		}
		else
		$dato = array('success' => false,'ms' => false);

		return Response::json($dato);
	}

	public function postElemento()
	{
		$rules = array(
			'id' => 'integer',
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{
			$dato = array(
				'success'=>false,
				'errormessage'=>'<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error'
			);
			return Response::json($dato);
		}
		$elemento = Elemento::find(Input::get('id'));
		$fotoperfil ="default.png";
		$matricula = 'Sin registro';
		if(!is_null($elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() ) )
		{
			$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		}
		if(!is_null($elemento -> matricula ))
		{
			$matricula = $elemento -> matricula -> id;
		}
		$grado = $elemento -> grados -> last();
		$examenesHechos = $elemento -> examenes() -> where('grado_id','=',$grado -> id) -> get();
		$totalexamenes = Examen::where('grado_id','=',$grado -> id) -> get();
		$examenesNoHechos = $totalexamenes;
		$i = 0;
		foreach ($examenesNoHechos as $examen) {
			foreach ($examenesHechos as $hecho) {
				if ($examen -> id == $hecho -> id) {
					unset($examenesNoHechos[$i]);
				}
			}
			$i++;
		}
		// $rr = ;
		$dato = array(
			'success' => true,
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
			'matricula' => $matricula,
			'nace' => $elemento -> fechanacimiento,
			'companiasysubzonas' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
			'tutor' => $elemento -> tutor -> persona -> nombre.' '.$elemento -> tutor -> persona -> apellidopaterno.' '.$elemento -> tutor -> persona -> apellidomaterno,
			'telcontacto' => $elemento -> tutor -> persona -> telefonos() -> get(),
			'domicilio' => $elemento -> calle.' '.$elemento -> colonia. ' '.$elemento -> municipio.' '.$elemento -> cp,
			'alergia' => $elemento -> alergias,
			'adiccion' => $elemento -> adiccion,
			'sangre' => $elemento -> tiposangre,
			'grado' => $grado -> nombre,
			'tel' => $elemento -> persona -> telefonos() -> get(),
			'email' => $elemento -> persona -> email,
			'facebook' => $elemento -> persona -> facebook,
			'twitter' => $elemento -> persona -> twitter,
		);
		return ($dato);
	}

	public function getLugares()
	{
		$companiasysubzonas = Companiasysubzona::all();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = array(
				'id' => $compayzona->id,
				'nombre' => $compayzona->tipo.' '.$compayzona->nombre
				);
		}
		return Response::json($companiasysubzonasArr);
	}

	public function postExtendidos()
	{
		$lugar_id = $_POST['id'];
		$lugar = Companiasysubzona::find($lugar_id);
		$elementos = $lugar -> elementos() -> get();
		$dato = array();
		$dato = array();
		foreach ($elementos as $elemento) {
			if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Nuevo' || $elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') {
				$dato[] = array(
					'id' => $elemento->id,
					'nombre' => $elemento->persona->nombre,
					'paterno' => $elemento->persona->apellidopaterno,
					'materno' => $elemento->persona->apellidomaterno,
					'fecha' => $elemento->fechanacimiento,
					'matricula' => $elemento->matricula,
					'ubicacion' => Companiasysubzona::find($elemento->companiasysubzona_id) -> nombre,
					);
			}
		}
		return Response::json($dato);
	}
}