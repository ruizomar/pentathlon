<?php
class AsignaCargosController extends BaseController {

	public function editar()
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

	public function buscar()
	{
		$id = $_POST['id'];
		$elemento = Elemento::find($id);
		$fotoperfil ="default.png";
		if(!is_null($elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() ) )
		{
			$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		}
		$dato = array(
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
		);
		return ($dato);
	}

	public function update()
	{
		$elemento = Elemento::find(30);
		$elemento->grados()->attach(Input::get('cargo'), array('fecha_inicio' => date('Y-m-d'),'fecha_fin' => date('Y-m-d')));

	}

}