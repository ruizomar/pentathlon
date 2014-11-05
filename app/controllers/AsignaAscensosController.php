<?php
class AsignaAscensosController extends BaseController {

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

		return View::make('ascensos.asignar')->with('cargos',$cargosArr)->with('companiasysubzonas',$companiasysubzonasArr);
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
		$grado = $elemento ->grados -> last();
		$dato = array(
			'id' => $id,
			'success' => true,
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
			'matricula' => $matricula,
			'grado' => $grado -> nombre,
			'fechagrado' => $grado -> pivot -> fecha,
			'companiasysubzonas' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
		);
		return ($dato);
	}

	public function postUpdate()
	{
		// $nombre = $_REQUEST['cargo'];
		$id = Input::get('id');
		$elemento = Elemento::find($id);
		$cargo = Input::get('cargo');
		$companiasysubzona = Input::get('companiasysubzona');
		// $elemento -> cargos() -> detach(array('cargo_id' => 1));

		// $q = $elemento -> cargos() -> select('elemento_id') -> get();
/*
		$q = $elemento -> cargos() -> where('cargo_id','=',2) -> get();
		$dato = array(
			'success' => false,
			'id' => '12',
			);*/
		$q = Cargo::find($cargo) -> elementos() -> orderBy('fecha_fin','asc') -> first();

		if(count($q) == 0)
		{
			$datos = array(
				'success' => true,
				'cuando' => 1,
				);
		}
		else
		{
			$lugar = $q -> companiasysubzona_id;
			if ($lugar == $companiasysubzona)
			{
				//falta comprobar si tiene fecha fin o está activo
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
					'success' => true,
					'cuando' => 2,
					);
			}
		}

		return Response::json($datos);
	}

	public function registrarAscenso($id)
	{
		$elemento = Elemento::find($id);
		$elemento->grados()->attach(1, array('fecha' => date('Y-m-d')));
		$status = $elemento->status()->save(new Statu(array(
					'tipo' => 'Activo',
					'inicio' => date("Y-m-d"),
					'descripcion' => 'Nuevo elemento')));
	}

}