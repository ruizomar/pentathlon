<?php 
class CompaniasController extends BaseController{

	public function getIndex(){
		$companias = Companiasysubzona::all();
		return View::make('administracion/companias')->with('companias',$companias);
	}

	public function postUpdate(){
		$rules = array(
			'id' => 'integer',
			'nombre' => 'required'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}

		$id = Input::get('id');
		$nombre = Input::get('nombre');
		$tipo = Input::get('tipo');
		$estatus = Input::get('estatus');

		$compania = Companiasysubzona::where('nombre','=',$nombre)->first();
		if ($id == "" && is_null($compania)) {
			$compania = new Companiasysubzona;
				$compania->nombre = $nombre;
				$compania->tipo = $tipo;
				$compania->estatus = $estatus;
			$compania->save();
		}
		else{
			if(!is_null($compania))
				if($compania->id != $id)
					return Redirect::back()->with('status', 'fail_create');
			if(is_null($compania))
				$compania = Companiasysubzona::find($id);
			$compania->nombre = $nombre;
			$compania->tipo = $tipo;
			$compania->estatus = $estatus;
			$compania->save();
			if ($compania->estatus == 'Inactiva');
				CompaniasController::bajaElementos($compania->id);
				CompaniasController::bajainstructor($compania->id);
			}
		
		return Redirect::back()->with('status', 'ok_create');
	}

	public function bajaElementos($compania){

		$elementos = Elemento::where('companiasysubzona_id','=',$compania)->get();
		foreach ($elementos as $elemento) {
			$estatus = $elemento->status()->orderBy('inicio','desc')->first();
			if ($estatus->tipo == 'Activo') {
				$status = $elemento->status()->save(new Statu(
					array(
					'tipo' => 'Inactivo',
					'inicio' => date("Y-m-d"),
					'descripcion' => 'Su compañia esta Inactiva'))
				);
			}
		}
	}

	public function bajaInstructor($compania){
		$instructores = Cargo::find(6)->elementos()->where('fecha_fin','=',null,'and')
						->where('Companiasysubzona_id','=',$compania)->get();
		 
		foreach ($instructores as $instructor) {
				$instructor->pivot->fecha_fin = date("Y-m-d");
				$instructor->pivot->save();
		}
	}
}