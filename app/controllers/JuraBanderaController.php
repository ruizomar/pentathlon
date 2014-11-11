<?php
class JuraBanderaController extends BaseController {

	public function getIndex()
	{
		$lugar = Companiasysubzona::find(1);
		$elementos = $lugar -> elementos() -> get();
		$temp = array();
		foreach ($elementos as $elemento) {
			$ele = Elemento::find($elemento -> id);
			$activo = $ele -> status -> last() -> tipo;
			$matricula = $ele -> matricula;
			if($activo == 'Activo' && !is_null($matricula)){
				$personaElemento = $ele -> persona;
				$temp[] = array(
					'nombre' => $personaElemento -> nombre,
					'paterno' => $personaElemento -> apellidopaterno,
					'materno' => $personaElemento -> apellidomaterno,
					'matricula' => $matricula -> matricula,
					'id_elemento' => $elemento -> id,
					'id_persona' => $personaElemento -> id,
				);
			}
		}
		// return View::make('jura.asignar') -> with('elementos',json_encode($temp));
		return View::make('jura.asignar') -> with('elementos',($temp));
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


}