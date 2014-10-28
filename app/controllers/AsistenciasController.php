<?php 
class AsistenciasController extends BaseController{

	public function getIndex($id){

		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','6')->first();
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
		$companias = Companiasysubzona::all();
		return View::make('reportes/asistencias')->with('companias',$companias);
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