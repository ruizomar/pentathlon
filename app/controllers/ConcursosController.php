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
				if($valIntegrante->fails()){
					$dato = array(
						'success'=>false,
						'errormessage'=>'Revisa los datos de los integrantes'
					);
					return Response::json($dato);
				}
				else{
					Concursante::create(array(
						'evento_id' => 1,
						'nombre' => $integrante['nombre'],
						'paterno' => $integrante['paterno'],
						'materno' => $integrante['materno'],
						'telefono' => $integrante['telefono'],
						'email' => $integrante['email'],
						'escuela' => $data['equipo']['escuela'],
						'estado' => $data['equipo']['estado'],
						'tipo' => 'integrante',
					));
				}
			}
		}
		Concursante::create(array(
			'evento_id' => 1,
			'nombre' => $data['lider']['nombre'],
			'paterno' => $data['lider']['paterno'],
			'materno' => $data['lider']['materno'],
			'telefono' => $data['lider']['telefono'],
			'email' => $data['lider']['email'],
			'escuela' => $data['equipo']['escuela'],
			'estado' => $data['equipo']['estado'],
			'tipo' => 'lider',
		));
		$dato = array(
			'success' => true,
		);
		return Response::json($dato);
	}
}
