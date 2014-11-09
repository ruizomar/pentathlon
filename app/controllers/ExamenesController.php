<?php 
class ExamenesController extends BaseController{
	public function getIndex(){
		$grados = array();
		foreach (Grado::all() as $grado) {
			$grados[$grado->id] = $grado->nombre;
		}
		return View::make('examenes/examenes')->with('examenes',Examen::all())->with('grados',$grados);
	}

	public function postExamenes(){
		return Response::json(
			Elemento::find(Input::get('id'))->grados()
			->orderBy('fecha','desc')->first()->examenes()->get()
		);
	}

	public function postNuevo(){
		$rules = array(
			'precio' 	=> 'integer|required',
			'nombre' 	=> 'required',
			'grado'		=>	'integer|required'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}
		if(is_null(Examen::where('nombre','=',Input::get('nombre'))
			->where('grado_id','=',Input::get('grado'))->first()) ){
			$examen = new Examen;
				$examen->nombre 	= Input::get('nombre');
				$examen->grado_id 	= Input::get('grado');
				$examen->costo 		= Input::get('precio');
			$examen->save();

			return Redirect::back()->with('status', 'ok_create');
		}
		else
			return Redirect::back()->with('status', 'ocupado');
	}
	public function postUpdate(){
		$rules = array(
			'precio' 	=>	'integer|required',
			'nombre' 	=>	'required',
			'grado'		=>	'integer|required',
			'id'		=>	'integer|required'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->withInput()->with('status', 'fail_create');
		}
		$examen = Examen::where('nombre','=',Input::get('nombre'))
						->where('grado_id','=',Input::get('grado'))->first();
		if(!is_null($examen) )
			if($examen->id != Input::get('id'))
					return Redirect::back()->with('status', 'ocupado');

			$examen = Examen::find(Input::get('id'));
			$examen->update(array(
				'nombre' 	=> Input::get('nombre'),
				'grado_id' 	=> Input::get('grado'),
				'costo'		=> Input::get('precio')
				));
		return Redirect::back()->with('status', 'ok_create');
	}

	public function getCalificaciones($id){
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
		
		return View::make('examenes/calificaciones')
						->with('elementos',$elementoss)
						->with('compania',$compania)
						->with('id',$id);
		}
		else
			echo "No eres instructor lastimanente";
	}
}