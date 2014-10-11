<?php 
class AsistenciasController extends BaseController{

	public function getIndex($id){

		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','6')->first();
		if(!is_null($conf)){									
		$instructorid = $id;

		$compania = Elemento::find($id)->companiasysubzona;

		$elementos = $compania->elementos()->where('id','<>',$instructorid)->get();
		/*$elementos = Elemento::all()->status()->where('tipo','=','Acivo','and')
								->where('id','<>',$instructorid)
								->where('companiasysubzona_id','=',$compania->id)*/
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

}	