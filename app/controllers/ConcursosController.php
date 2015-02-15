<?php
class ConcursosController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('nombre','=','tecnica')->first()) && is_null(User::find(Auth::id())->roles()->where('nombre','=','tecnica')->first()))
    	 		return Redirect::to('inicio');
        }, array('only' => array('getReporte')));
    }

	public function getIndex()
	{
		return View::make('concursos.concursos');
	}

	public function getEvento()
	{
		return View::make('concursos.concursos');
	}

	public function getReporte(){
		return View::make('concursos.reporte');
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
		$data = $_POST['data'];
		$reglasArray = array(
			'integrantes' => 'required|min:6',
		);
		$reglasPersona = array(
			'nombre' => 'required|max:35',
			'paterno' => 'required|max:35',
			'materno' => 'max:35',
			'telefono' => 'numeric',
			'email' => 'email',
		);
		$reglasIntegrantes = array(
			'nombre' => 'required|max:35',
			'paterno' => 'required|max:35',
			'materno' => 'max:35',
			'posicion' => array('required','regex:/^(Abanderado|Sargento|Escolta derecho|Escolta izquierdo|Guardia derecho|Guardia izquierdo)$/'),
		);
		$reglasEquipo = array(
			'escuela' => 'required|max:35',
			'estado' => array('required','regex:/^(Aguascalientes|Baja California|Baja California Sur|Campeche|Chiapas|Chihuahua|Coahuila|Colima|Distrito Federal|Durango|Estado de México|Guanajuato|Guerrero|Hidalgo|Jalisco|Michoacán|Morelos|Nayarit|Nuevo León|Oaxaca|Puebla|Querétaro|Quintana Roo|San Luis Potosí|Sinaloa|Sonora|Tabasco|Tamaulipas|Tlaxcala|Veracruz|Yucatán|Zacatecas)$/'),
			'nivel' => array('required','regex:/^(Secundaria|Bachillerato|Licenciatura)$/'),
		);
		$reglasPDMU = array(
			'nombre' => 'required|max:35',
			'paterno' => 'required|max:35',
			'materno' => 'max:35',
		);
		$valArray = Validator::make($data, $reglasArray);
		$valLider = Validator::make($data['lider'], $reglasPersona);
		$valEquipo = Validator::make($data['equipo'], $reglasEquipo);
		$valPDMU = Validator::make($data['pdmu'], $reglasPDMU);
		if($valEquipo->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Revisa los datos de la escuela'
			);
			return Response::json($dato);
		}
		if($valLider->fails()){
			$dato = array(
				'success'=>false,
				'errormessage'=>'Revisa los datos del responsable'
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
				'errormessage'=>'Revisa la información del acompañante del PDMU'
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
			}
		}
		$equipo = Equipo::create(array(
			'evento_id' => 1,
			'correo' => $data['lider']['email'],
			'telefono' => $data['lider']['telefono'],
			'escuela' => $data['equipo']['escuela'],
			'estado' => $data['equipo']['estado'],
			'nivel' => $data['equipo']['nivel'],
		));
		foreach ($data['integrantes'] as $integrante) {
			Concursante::create(array(
					'equipo_id' => $equipo -> id,
					'nombre' => $integrante['nombre'],
					'paterno' => $integrante['paterno'],
					'materno' => $integrante['materno'],
					'tipo' => $integrante['posicion'],
			));
		}
		Concursante::create(array(
			'equipo_id' => $equipo -> id,
			'nombre' => $data['pdmu']['nombre'],
			'paterno' => $data['pdmu']['paterno'],
			'materno' => $data['pdmu']['materno'],
			'tipo' => 'PDMU',
		));
		Concursante::create(array(
			'equipo_id' => $equipo -> id,
			'nombre' => $data['lider']['nombre'],
			'paterno' => $data['lider']['paterno'],
			'materno' => $data['lider']['materno'],
			'tipo' => 'Responsable',
		));
		$dato = array(
			'success' => true,
		);
		return Response::json($dato);
	}

	public function postEscuelas()
	{
		$estado = Input::get('estado');
		$nivel = Input::get('nivel');
		$equipos = Equipo::where('estado','=',$estado) -> where('nivel','=',$nivel) -> select('id','escuela') -> orderBy('escuela') -> get();
		return Response::json($equipos);
	}

	public function postEscuela()
	{
		$equipo = Equipo::find(Input::get('id'));
		$equipoArr = array();
		foreach ($equipo -> concursantes() -> get() as $concursantes) {
			$equipoArr[] = array(
				$concursantes -> nombre,
				$concursantes -> paterno,
				$concursantes -> materno,
				$concursantes -> tipo,
				$equipo -> estado,
				$equipo -> escuela,
				$equipo -> nivel,
				$equipo -> correo,
				$equipo -> telefono,
			);
		}
		return Response::json($equipoArr);
	}

	public function getTotal()
	{
		$totales = array();
		$estados = ['Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila','Colima','Distrito Federal','Durango','Estado de México','Guanajuato','Guerrero','Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz','Yucatán','Zacatecas'];
		foreach ($estados as $estado) {
			$totales[] = ConcursosController::conteo($estado);
		}
		$data = array(
			'data' => $totales,
			'secundaria' => count(Equipo::where('nivel','=','Secundaria') -> get()),
			'bachillerato' => count(Equipo::where('nivel','=','Bachillerato') -> get()),
			'licenciatura' => count(Equipo::where('nivel','=','Licenciatura') -> get()),
		);
		return Response::json($data);
	}

	private function conteo($estado)
	{
		$con = 0;
		return array(
			$estado,
			$equipo = count(Equipo::where('estado','=',$estado) -> where('nivel','=','Secundaria') -> get()),
			$equipo = count(Equipo::where('estado','=',$estado) -> where('nivel','=','Bachillerato') -> get()),
			$equipo = count(Equipo::where('estado','=',$estado) -> where('nivel','=','Licenciatura') -> get()),
			$equipo = count(Equipo::where('estado','=',$estado) -> get()),
		);
	}
}
