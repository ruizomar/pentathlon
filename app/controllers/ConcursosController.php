<?php
class ConcursosController extends BaseController {

	public function __construct()
    {
        // $this->beforeFilter('auth');
    }

	public function getIndex()
	{
		return View::make('concursos.concursos');
	}

	public function getEvento()
	{
		return View::make('concursos.concursos');
	}

	public function postGuardar()
	{
		$data = $_POST['data'];
		$reglasArray = array(
			'integrantes' => 'required',
		);
		$reglasPersona = array(
		'nombre' => 'required',
		'paterno' => 'required',
		'telefono' => 'required|integer|min:10',
		'email' => 'email',
		);
		$reglasEquipo = array(
		'estado' => 'required',
		'escuela' => 'required',
		);
		$valArray = Validator::make($data, $reglasArray);
		$valLider = Validator::make($data['lider'], $reglasPersona);
		$valEquipo = Validator::make($data['equipo'], $reglasEquipo);
		if($valLider->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesita información del responsable'
			);
			return Response::json($dato);
		}
		if($valEquipo->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesita información del equipo'
			);
			return Response::json($dato);
		}
		if($valArray->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesitan integrantes en el equipo'
			);
			return Response::json($dato);
		}
		else{
			foreach ($data['integrantes'] as $integrante) {
				$valIntegrante = Validator::make($integrante, $reglasPersona);
			}
			if($valIntegrante->fails()){
				$dato = array(
					'success'=>false,
					'errormessage'=>'Revisa los datos de los integrantes'
				);
				return Response::json($dato);
			}
			return Response::json('TODO BUENAS');
		}
		// $concursante = Concursante::create(array(
		// 	'evento_id' => 1,
		// 	'nombre' => 'nombre',
		// 	'paterno' => 'paterno',
		// 	'materno' => 'materno',
		// 	'telefono' => 'telefono',
		// 	'email' => 'email',
		// 	'escuela' => 'escuela',
		// 	'estado' => 'estado',
		// 	'tipo' => 'tipo',
		// ));
		// return Response::json($data['integrantes']);
		// $c = $data['integrantes'];
		// foreach ($data['integrantes'] as $integrante) {
		// 	$c++;
		// }
		// return $c;

	}
}
