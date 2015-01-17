<?php
class AsignaAscensosController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
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
			$matricula = $elemento -> matricula -> id;
		}
		$grado = $elemento -> grados -> last();
		$examenesHechos = $elemento -> examenes() -> where('grado_id','=',$grado -> id) -> get();
		$totalexamenes = Examen::where('grado_id','=',$grado -> id) -> get();
		$examenesNoHechos = $totalexamenes;
		$i = 0;
		foreach ($examenesNoHechos as $examen) {
			foreach ($examenesHechos as $hecho) {
				if ($examen -> id == $hecho -> id) {
					unset($examenesNoHechos[$i]);
				}
			}
			$i++;
		}
		// $rr = ;
		$dato = array(
			'id' => $id,
			'success' => true,
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'fotoperfil' => $fotoperfil,
			'matricula' => $matricula,
			'grado' => $grado -> nombre,
			'ascenso' => Grado::find($grado -> id + 1) -> nombre,
			'ascenso_id' => $grado -> id + 1,
			'fechagrado' => $grado -> pivot -> fecha,
			'companiasysubzonas' => $elemento -> companiasysubzona -> tipo .' '. $elemento ->  companiasysubzona -> nombre,
			'faltas' => count($elemento -> asistencias() -> where('tipo' , '=' , 0) -> get()),
			'permisos' => count($elemento -> asistencias() -> where('tipo' , '=' , 2) -> get()),
			'asistencias' => count($elemento -> asistencias() -> where('tipo' , '=' , 1) -> get()),
			'examenes' => $elemento -> examenes() -> where('grado_id','=',$grado -> id) -> get(),
			'reconocimientos' => $elemento -> reconocimientos,
			'pagos' => 'Ya pago',
			'examenesNoHechos' => $examenesNoHechos,
		);
		return ($dato);
	}

	public function postAscender()
	{
		$ascenso_id = $_POST['ascenso_id'];
		$elemento_id = $_POST['elemento_id'];
		$personaElemento = Ascenso::create(array(
			'grado_id' => $ascenso_id,
			'elemento_id' => $elemento_id,
			'fecha' => date('Y-m-d'),
		));
		return Response::json($personaElemento);
	}
}