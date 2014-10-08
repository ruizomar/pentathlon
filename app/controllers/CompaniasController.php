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
			}
		
		//return Redirect::back()->with('status', 'ok_create');
	}

	public function bajaElementos($id){

		$elementos = Elemento::where('companiasysubzona_id','=',$id)->get();
		foreach ($elementos as $elemento) {
			$estatus = $elemento->status()->where('fin','=',null,'and')
								->where('tipo','=','Alta')->first();
			if (!is_null($estatus)) {
				$estatus->fin = date("Y-m-d");
				$estatus->save();
				$statu = new Statu(array(
					'tipo' => 'Inactivo',
					'inicio' => date("Y-m-d"),
					'descripcion' => 'Su compañia esta Inactiva'));
				$status = $elemento->status()->save($statu);
			}
			
		}
	}

	public function bajaInstructor($is){
		
	}
}