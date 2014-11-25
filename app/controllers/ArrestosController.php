<?php 
class ArrestosController extends BaseController{

	public function getIndex(){
		return View::make('arrestos/arrestos');
	}

	public function postElemento(){
		$elemento = Elemento::find(Input::get('id'));
		$matricula = $elemento->matricula;
			$nummatricula="";
			if (!is_null($matricula)) {
				$nummatricula = $matricula->id;
			}
		$dato = array(
			'nombre'	=> $elemento->persona->nombre.' '.$elemento->persona->apellidopaterno.' '.$elemento->persona->apellidomaterno,
			'fecha'		=> $elemento->fechanacimiento,
			'matricula' => $nummatricula,
			'foto'		=> $elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta,
			'grado'		=> $elemento->grados()->orderBy('fecha','desc')->first()->nombre,
			'compania'	=> $elemento->companiasysubzona->tipo." ".$elemento->companiasysubzona->nombre
			);
			return Response::json($dato);
	}

		

}