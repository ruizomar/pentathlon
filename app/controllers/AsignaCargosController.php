<?php
class AsignaCargosController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('archivo');
    }

	public function getIndex()
	{
		$cargos = Cargo::all();
		$cargosArr = array();
		foreach($cargos as $cargo)
		{
			$cargosArr[$cargo->id] = $cargo->nombre;
		}

		$companiasysubzonas = Companiasysubzona::where('status','=','activa')->get();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = $compayzona->nombre;
		}

		return View::make('cargos.asignar')->with('cargos',$cargosArr)->with('companiasysubzonas',$companiasysubzonasArr);
	}

	public function postBuscar()
	{
		$id = $_POST['id'];
		$elemento = Elemento::find($id);
		$fotoperfil ="default.png";
		$matricula = false;
		if(!is_null($elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() ) )
		{
			$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		}
		if(!is_null($elemento -> matricula ))
		{
			$matricula = $elemento -> matricula -> id;
		}
		$cargos = $elemento -> cargos() -> get();
		$cargo = array();
		foreach ($cargos as $carge) {
			if (is_null($carge -> pivot -> fecha_fin)) {
				$cargo[] = array(
					'nombre' => $carge -> nombre,
					'cargo_id' => $carge -> id,
					'elemento_id' => $id,
					);
			}
		}
		$dato = array(
			'success' => true,
			'id' => $id,
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
			'matricula' => $matricula,
			'cargo' => $cargo,
			'companiasysubzonas' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
			'compania'	=>	$elemento->companiasysubzona_id,
		);
		return ($dato);
	}

	public function postConfirma()
	{
		$cargo = Input::get('cargo');
		$elementos = Cargo::find($cargo) -> elementos() -> get();
		$q = array();
		foreach ($elementos as $elemento) {
			if($cargo<10){
				if(is_null($elemento -> pivot -> fecha_fin)){
					$q = array(
						'success' => false,
						'nombre' => $elemento -> persona -> nombre,
						'paterno' => $elemento -> persona -> apellidopaterno,
						'materno' => $elemento -> persona -> apellidomaterno,
						);
				}
			}
			if ($elemento -> companiasysubzona_id == Input::get('companiasysubzona')) {
				if(is_null($elemento -> pivot -> fecha_fin)){
					$q = array(
						'success' => false,
						'nombre' => $elemento -> persona -> nombre,
						'paterno' => $elemento -> persona -> apellidopaterno,
						'materno' => $elemento -> persona -> apellidomaterno,
						);
				}
			}
		}
		if(count($q) == 0)
		{
			$q = array(
				'success' => true,
				'tama' => $elementos
				);
		}
		return Response::json($q);
	}

	public function postUpdate()
	{
		$id = Input::get('id');
		$elemento = Elemento::find($id);
		$cargo = Input::get('cargo');
		if ($cargo == 12) {
			Elemento::find($id)
			-> update(array(
				'companiasysubzona_id' => Input::get('companiasysubzona'),
			));
		}
		$elementos = Cargo::find($cargo) -> elementos() ->where('companiasysubzona_id',$elemento->companiasysubzona_id) -> get();
		if($cargo<10){
			$elementos = Cargo::find($cargo) -> elementos() -> get();
		}
		$q = array();
		foreach ($elementos as $elem) {
			if(is_null($elem -> pivot -> fecha_fin)){
				$q = array('id' => $elem,);
				$elem -> cargos() -> updateExistingPivot($cargo, array( 'fecha_fin' => date('Y-m-d')) );
				$elemento -> cargos() -> attach($cargo, array( 'fecha_inicio' => date('Y-m-d') ) );
			}
		}
		if(count($q) == 0)
		{
			$elemento -> cargos() -> attach($cargo, array( 'fecha_inicio' => date('Y-m-d') ) );
		}
		$carg = array();
		$cargos = $elemento -> cargos;
		foreach ($cargos as $carge) {
			if (is_null($carge -> pivot -> fecha_fin)) {
				$carg[] = array(
					'nombre' => $carge -> nombre,
					'cargo_id' => $carge -> id,
					'elemento_id' => $id,
					);
			}
		}
		$elemento = Elemento::find($id);
		$datos = array(
			'success' => true,
			'cargo' => $carg,
			'ubicacion' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
		);
		return Response::json($datos);
	}

	public function postEliminar()
	{
		$id = $_POST['id'];
		$cargo = $_POST['cargo'];
		DB::table('cargo_elemento')
			-> where('cargo_id','=',$cargo)
			-> where('elemento_id','=',$id)
			-> whereNull('fecha_fin')
			-> update(array(
				'fecha_fin' => date('Y-m-d'),
			));
		$message = DB::delete('DELETE FROM cargo_elemento WHERE fecha_fin = fecha_inicio');
		$datos = array(
			'success' => true,
			'message' => $message,
		);
		return Response::json($datos);
	}

}