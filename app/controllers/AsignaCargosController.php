<?php
class AsignaCargosController extends BaseController {

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
		$matricula = 'Sin registro';
		if(!is_null($elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() ) )
		{
			$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		}
		if(!is_null($elemento -> matricula ))
		{
			$matricula = $elemento -> matricula -> matricula;
		}
		$cargos = $elemento -> cargos;
		$cargo = array();
		foreach ($cargos as $carge) {
			if (is_null($carge -> pivot -> fecha_fin)) {
				$cargo[] = $carge -> nombre;
			}
		}
		$dato = array(
			'id' => $id,
			'success' => true,
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
			'matricula' => $matricula,
			'cargo' => $cargo,
			'companiasysubzonas' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
		);
		return ($dato);
	}

	public function postConfirma()
	{
		$id = Input::get('id');
		$elemento = Elemento::find($id);
		$cargo = Input::get('cargo');
		$companiasysubzona = Input::get('companiasysubzona');
		$q = Cargo::find($cargo) -> elementos() -> where('companiasysubzona_id','=',$companiasysubzona) -> first();

		if(count($q) == 0)
		{
			$datos = array(
				'nombre' => 'jaja',
				'success' => true,
				'cuando' => 1,
				);
		}
		else
		{
			if (is_null($q -> pivot -> fecha_fin))
			{
				$datos = array(
					'success' => false,
					'nombre' => $q -> persona -> nombre,
					'paterno' => $q -> persona -> apellidopaterno,
					'materno' => $q -> persona -> apellidomaterno,
					);
			}
			else
			{
				$datos = array(
					'nombre' => 'jeje',
					'success' => true,
					'cuando' => 2,
					);
			}
		}
		return Response::json($datos);
	}

	public function postUpdate()
	{
		$id = Input::get('id');
		$elemento = Elemento::find($id);
		$cargo = Input::get('cargo');
		$companiasysubzona = Input::get('companiasysubzona');
		$q = Cargo::find($cargo) -> elementos() -> where('companiasysubzona_id','=',$companiasysubzona) -> first();

		if(count($q) == 0)
		{
			// $elemento->cargos()->attach($cargo, array( 'fecha_inicio' => date('Y-m-d') ) );
			$cuando = 1;
		}
		else
		{
			$cuando = 2;
		}
		$carg = array();
		$cargos = $elemento -> cargos;
		foreach ($cargos as $carge) {
			if (is_null($carge -> pivot -> fecha_fin)) {
				$carg[] = $carge -> nombre;
			}
		}
		$datos = array(
			'success' => true,
			'cuando' => $cuando,
			'cargo' => $carg,
		);

		return Response::json($datos);
	}

}