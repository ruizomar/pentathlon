<?php
class JuraBanderaController extends BaseController {

	public function getIndex()
	{
		$companiasysubzonas = Companiasysubzona::where('status','=','activa')->get();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = $compayzona->tipo.' '.ucwords(strtolower($compayzona->nombre));
		}
		$lugar = Companiasysubzona::find(1);
		return View::make('jura.jura') -> with('lugares',$companiasysubzonasArr);
	}

	public function postLlenartabla()
	{
		$lugar_id = $_POST['id'];
		$lugar = Companiasysubzona::find($lugar_id);
		$elementos = $lugar -> elementos() -> get();
		$elementosArr = array();
		foreach ($elementos as $elemento) {
			$activo = $elemento -> status -> last() -> tipo;
			$matricula = $elemento -> matricula;
			if($activo == 'Nuevo' && !is_null($matricula)){
				$personaElemento = $elemento -> persona;
				$elementosArr[] = array(
					'nombre' => $personaElemento -> nombre,
					'paterno' => $personaElemento -> apellidopaterno,
					'materno' => $personaElemento -> apellidomaterno,
					'matricula' => $matricula -> matricula,
					'elemento_id' => $elemento -> id,
					'persona_id' => $personaElemento -> id,
				);
			}
		}
		return Response::json($elementosArr);
	}

	public function postJurar()
	{
		$rr = Grado::all();
		$datos = $_POST['data'];
		return Response::json($datos[0]["elemento_id"]);
	}
}