<?php 
class AsistenciasController extends BaseController{

	 public function __construct()
    {
        $this->beforeFilter('auth');
        //$this->beforeFilter('instructor', array('only' => 'getIndex');
       	//$this->beforeFilter('investigacion', array('only' => 'getReporte');
    }
	public function getIndex(){
		$id = Auth::user()->elemento_id;
		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','12')->first();
		if(!is_null($conf)){
											
		$instructorid = $id;
		$compania = Elemento::find($id)->companiasysubzona;

		$elementos = $compania->elementos()->where('id','<>',$instructorid)->get();
		$elementoss = array();
		foreach ($elementos as $elemento) {
			$estatus = $elemento->status()->orderBy('inicio','desc')->first();
			if ($estatus->tipo == 'Activo') {
				$elementoss[] = $elemento;
			}
		}
		$fechas = Elemento::find($instructorid)->asistencias()
					->orderBy('fecha','desc')->take(4)->get();
		
		return View::make('administracion/asistencias')
						->with('elementos',$elementoss)
						->with('compania',$compania)
						->with('fechas',$fechas)
						->with('id',$id);
		}
		else
			echo "No eres instructor lastimanente";
	}
	public function postNueva(){

		$fecha = Input::get('fecha');
		$compania = Elemento::find(Input::get('instructor'))->companiasysubzona_id;
		$asistencia = Elemento::find(Input::get('instructor'))->asistencias()
		->save(new Asistencia(array(
				'companiasysubzona_id' => $compania,
				'fecha' => $fecha,
				'tipo' => 1))
			);

		foreach (Input::all() as $key => $value) {
				if(is_numeric($key)){
					$asistencia = Asistencia::create(array(
						'elemento_id' => $key,
						'companiasysubzona_id' => $compania,
						'fecha' => $fecha,
						'tipo' => $value));
				}
		}
		return Redirect::back();
	}

	public function getReporte(){
		$id = Auth::user()->elemento_id;
		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','12')->first();
		if(!is_null($conf)){
			$compania = Elemento::find($id)->companiasysubzona;
			$companiasysubzonasArr = array();
			$companiasysubzonasArr[$compania->id] = $compania->tipo.' '.$compania->nombre;
			return View::make('administracion/reportes')->with('compania',$companiasysubzonasArr);
		}
		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','6')->first();
		if(!is_null($conf)){
			$companiasysubzonas = Companiasysubzona::where('status','=','activa')->get();
			$companiasysubzonasArr = array();
			foreach($companiasysubzonas as $compayzona)
			{
				$companiasysubzonasArr[$compayzona->id] = $compayzona->tipo.' '.$compayzona->nombre;
			}
			return View::make('administracion/reportes')->with('compania',$companiasysubzonasArr);
		}
		if(is_null($conf)){
			echo "No eres instructor lastimanentes";
		}

	}

	public function postDia(){
		$inicio = new DateTime(Input::get('i'));
		$lugar = Input::get('lugar');
		$elementos = Elemento::where('companiasysubzona_id','=',$lugar) -> get();
		$data = array();
		foreach ($elementos as $elemento) {
			$asistencias = 0;
			$permisos = 0;
			$faltas = 0;
			$estatus = $elemento->status()->orderBy('inicio','desc')->first();
			if ($estatus->tipo == 'Activo') {
				$lista = $elemento -> asistencias() -> where('fecha','=',$inicio) -> get();
				if (empty($lista)) {
					$data[] = array(
						'nombre' => $elemento -> persona -> nombre,
						'paterno' => $elemento -> persona -> apellidopaterno,
						'materno' => $elemento -> persona -> apellidomaterno,
						'asistencias' => 'sin resgistro',
					);
				}
				else{
					$data[] = array(
						'nombre' => $elemento -> persona -> nombre,
						'paterno' => $elemento -> persona -> apellidopaterno,
						'materno' => $elemento -> persona -> apellidomaterno,
						'asistencias' => $lista -> last() -> tipo,
					);
				}
			}
		}
		return Response::json($data);
	}

	public function postRango(){
		$inicio = new DateTime(Input::get('i'));
		$fin = new DateTime(Input::get('f'));
		$lugar = Input::get('lugar');
		$elementos = Elemento::where('companiasysubzona_id','=',$lugar) -> get();
		$data = array();
		foreach ($elementos as $elemento) {
			$asistencias = 0;
			$permisos = 0;
			$faltas = 0;
			$estatus = $elemento->status()->orderBy('inicio','desc')->first();
			if ($estatus->tipo == 'Activo') {
				$lista = $elemento -> asistencias() -> where('fecha','>',$inicio) -> where('fecha','<',$fin) -> get();
				foreach ($lista as $valor) {
					if($valor -> tipo == 1){
						$asistencias++;
					}
					if($valor -> tipo == 0){
						$faltas++;
					}
					if($valor -> tipo == 2){
						$permisos++;
					}
				}
				$data[] = array(
					'nombre' => $elemento -> persona -> nombre,
					'paterno' => $elemento -> persona -> apellidopaterno,
					'materno' => $elemento -> persona -> apellidomaterno,
					'asistencias' => $asistencias,
					'faltas' => $faltas,
					'permisos' => $permisos,
				);
			}
		}
		return Response::json($data);
	}

	public function postCompania(){

		$id = Input::get('id');
		$data = array();
		$fechas = DB::table('asistencias')->select('fecha')->distinct()
		->where('companiasysubzona_id','=',$id)->orderby('fecha','desc')->get();
		$data[] = $fechas;
		$asistencias = array();
		foreach ($fechas as $fecha) {
			$asistencias[] = Asistencia::where('fecha','=',$fecha->fecha,'and')
			->where('companiasysubzona_id','=',$id,'and')->where('tipo','=',1)->count();
		}
		$data[] = $asistencias;
		return Response::json($data);
	}
	public function postElemento(){
		$elemento = Elemento::find(Input::get('id'))->persona;
		$tutor = Tutor::where('elemento_id','=',Input::get('id'))->first();
		$data = array();
		$data['elemento'] 	= $elemento;
		$data['tutor'] 		= $tutor->persona;
		$data['relacion'] 	= $tutor->relacion;	
		$telefonosElemento 	= array();
		$telefonosTutor 	= array();
		if(count($elemento->telefonos()) > 0)
			foreach ($elemento->telefonos()->get() as $telefono) {
				$telefonosElemento[] = $telefono;
			}
		if(count($tutor->persona->telefonos()) > 0)
			foreach ($tutor->persona->telefonos()->get() as $telefono) {
				$telefonosTutor[] = $telefono;
			}	
		$data['telefonosElemento']	= $telefonosElemento;
		$data['telefonosTutor'] 	= $telefonosTutor;
		$data['correoElemento']		= $elemento->email;
		$data['correoTutor']		= $tutor->persona->email;

		return Response::json($data);	
	}
}	