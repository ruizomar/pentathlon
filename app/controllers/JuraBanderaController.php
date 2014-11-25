<?php
class JuraBanderaController extends BaseController {

	public function __construct()
    {
        // $this->beforeFilter('auth');
    }

	public function getIndex()
	{
		$companiasysubzonas = Companiasysubzona::where('status','=','activa')->get();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = $compayzona->tipo.' '.ucwords(strtolower($compayzona->nombre));
		}
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
		$elementos = $_POST['data'];
		foreach ($elementos as $elemento) {
			$id = $elemento['elemento_id'];
			$element = Elemento::find($id);
			// $element->grados()->attach(1, array('fecha' => date('Y-m-d')));
			$status = $element -> status() -> save(new Statu(array(
				'tipo' => 'Activo',
				'inicio' => date("Y-m-d"),
				'descripcion' => 'Jura de Bandera')));
		}
		return Response::json(true);
	}
}