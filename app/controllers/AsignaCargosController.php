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
				$cargo[] = array(
					'nombre' => $carge -> nombre,
					'companiasysubzona' => Companiasysubzona::find($carge -> pivot -> companiasysubzona_id) -> nombre,
					);
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
		$cargo = Input::get('cargo');
		$companiasysubzona = Input::get('companiasysubzona');
		$elementos = Cargo::find($cargo) -> elementos() -> get();
		$q = array();
		foreach ($elementos as $elem) {
			if ($elem -> pivot -> companiasysubzona_id == $companiasysubzona){
				if(is_null($elem -> pivot -> fecha_fin)){
					$q = array(
						'success' => false,
						'nombre' => $elem -> persona -> nombre,
						'paterno' => $elem -> persona -> apellidopaterno,
						'materno' => $elem -> persona -> apellidomaterno,
						);
				}
			}
		}
		if(count($q) == 0)
		{
			$q = array(
				'success' => true,
				);
		}
		return Response::json($q);
	}

	public function postUpdate()
	{
		$id = Input::get('id');
		$elemento = Elemento::find($id);
		$cargo = Input::get('cargo');
		$companiasysubzona = Input::get('companiasysubzona');
		$elementos = Cargo::find($cargo) -> elementos() -> get();
		$q = array();
		foreach ($elementos as $elem) {
			if ($elem -> pivot -> companiasysubzona_id == $companiasysubzona){
				if(is_null($elem -> pivot -> fecha_fin)){
					$q = array(
						'id' => $elem,
					);
					$elem -> cargos() -> updateExistingPivot($cargo, array( 'fecha_fin' => date('Y-m-d')) );
					$elemento -> cargos() -> attach($cargo, array( 'fecha_inicio' => date('Y-m-d'),'companiasysubzona_id' => $companiasysubzona ) );
					$cuando = 2;
					// User::find(1)->roles()->updateExistingPivot($roleId, $attributes);
				}
			}
		}
		if(count($q) == 0)
		{
			$cuando = 1;
			$elemento -> cargos() -> attach($cargo, array( 'fecha_inicio' => date('Y-m-d'),'companiasysubzona_id' => $companiasysubzona ) );
		}
		$carg = array();
			$cargos = $elemento -> cargos;
			foreach ($cargos as $carge) {
				if (is_null($carge -> pivot -> fecha_fin)) {
					$carg[] = array(
						'nombre' => $carge -> nombre,
						'companiasysubzona' => Companiasysubzona::find($carge -> pivot -> companiasysubzona_id) -> nombre,
						);
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