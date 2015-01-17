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
			'integrantes' => 'required|min:6',
		);
		$reglasPersona = array(
			'nombre' => 'required',
			'paterno' => 'required',
			'telefono' => 'required|integer|min:10',
			'email' => 'email',
		);
		$reglasIntegrantes = array(
			'nombre' => 'required',
			'paterno' => 'required',
			'posicion' => 'required',
		);
		$reglasEquipo = array(
			'estado' => 'required',
			'escuela' => 'required',
			'nivel' => 'required',
		);
		$reglasPDMU = array(
			'nombre' => 'required',
			'paterno' => 'required',
		);
		$valArray = Validator::make($data, $reglasArray);
		$valLider = Validator::make($data['lider'], $reglasPersona);
		$valEquipo = Validator::make($data['equipo'], $reglasEquipo);
		$valPDMU = Validator::make($data['pdmu'], $reglasPDMU);
		if($valEquipo->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesita información de la escuela'
			);
			return Response::json($dato);
		}
		if($valLider->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesita información del responsable'
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
		if($valPDMU->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Se necesita información del acompañante del PDMU'
			);
			return Response::json($dato);
		}
		else{
			foreach ($data['integrantes'] as $integrante) {
				$valIntegrante = Validator::make($integrante, $reglasIntegrantes);
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
						'telefono' => null,
						'email' => null,
						'escuela' => $data['equipo']['escuela'],
						'estado' => $data['equipo']['estado'],
						'tipo' => $integrante['posicion'],
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
		Concursante::create(array(
			'evento_id' => 1,
			'nombre' => $data['pdmu']['nombre'],
			'paterno' => $data['pdmu']['paterno'],
			'materno' => $data['pdmu']['materno'],
			'telefono' => null,
			'email' => null,
			'escuela' => $data['equipo']['escuela'],
			'estado' => $data['equipo']['estado'],
			'tipo' => 'PDMU',
		));
		$dato = array(
			'success' => true,
		);
		return Response::json($dato);
	}
}
