<?php
class ReunionController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth',array('only' => array('getReporte')));
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('nombre','=','tecnica')->first()) && is_null(User::find(Auth::id())->roles()->where('nombre','=','archivo')->first()))
    	 		return Redirect::to('inicio');
        }, array('only' => array('getReporte')));
    }

	public function getIndex()
	{
		return View::make('reunion.concursos');
	}

	public function getReporte(){
		return View::make('reunion.reporte');
	}

	public function postReporte(){
		$equipos = Equipo::where('estado','=',Input::get('state')) -> get();
		$secuArr = array();
		$bachiArr = array();
		$licArr = array();
		foreach ($equipos as $equipo) {
			foreach ($equipo -> concursantes() -> get() as $concursantes) {
				if ($equipo -> nivel == 'Secundaria') {
					$secuArr[] = array(
						$concursantes -> nombre,
						$concursantes -> paterno,
						$concursantes -> materno,
						$concursantes -> tipo,
						$equipo -> estado,
						$equipo -> escuela,
						$equipo -> nivel
					);
				}
				if ($equipo -> nivel == 'Bachillerato') {
					$bachiArr[] = array(
						$concursantes -> nombre,
						$concursantes -> paterno,
						$concursantes -> materno,
						$concursantes -> tipo,
						$equipo -> estado,
						$equipo -> escuela,
						$equipo -> nivel
					);
				}
				if ($equipo -> nivel == 'Licenciatura') {
					$licArr[] = array(
						$concursantes -> nombre,
						$concursantes -> paterno,
						$concursantes -> materno,
						$concursantes -> tipo,
						$equipo -> estado,
						$equipo -> escuela,
						$equipo -> nivel
					);
				}
			}
		}
		$data = array(
			'secundaria' => $secuArr,
			'bachillerato' => $bachiArr,
			'licenciatura' => $licArr
		);
		return Response::json($data);
	}

	public function postGuardar()
	{
		$count	= count(Input::get('grado'));
		for ($i=0; $i < $count; $i++) {
			Reunion::create(array(
				'zona'		=> Input::get('zona'),
				'grado'		=> Input::get('grado')[$i],
				'nombre'	=> Input::get('nombre')[$i],
				'reunion'	=> Input::get('reunion')[$i],
				'cargo'		=> Input::get('cargo')[$i],
				'seccion'	=> Input::get('seccion')[$i],
			));
		}
		return Redirect::to('reunion/guardado');
	}

	public function getGuardado()
	{
		return View::make('reunion.guardado');
	}
}
