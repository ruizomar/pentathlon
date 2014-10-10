<?php 
class AsistenciasController extends BaseController{

	public function getIndex($id){

		$conf = Elemento::find($id)->cargos()->where('fecha_fin','=',null,'and')
											->where('cargo_id','=','6')->first();
		if(!is_null($conf)){									
		$instructorid = $id;
		$compania = Elemento::find($instructorid)->companiasysubzona;
		$elementos = $compania->elementos()->where('id','<>',$instructorid)->get();
		$fechas = Elemento::find($instructorid)->asistencias()->orderBy('fecha','asc')->get();
		
		return View::make('administracion/asistencias')
						->with('elementos',$elementos)
						->with('compania',$compania)
						->with('fechas',$fechas);
		}
		else
			echo "error";
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
					$asistencia = Elemento::find($key)->asistencias()
					->save(new Asistencia(array(
							'companiasysubzona_id' => $compania,
							'fecha' => $fecha,
							'tipo' => $value))
						);
				}
		}
		return Redirect::back();
	}
	public function getIns($id){
		echo $id;
	}

}	