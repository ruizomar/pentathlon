<?php
class ReportesController extends BaseController {

	public function __construct()
    {
        // $this->beforeFilter('auth');
    }

	public function getIndex()
	{
		return View::make('reportes.reportes');
	}

	public function getLugares()
	{
		$companiasysubzonas = Companiasysubzona::all();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = array(
				'id' => $compayzona->id,
				'nombre' => ucwords(strtolower($compayzona->nombre)),
				'numelementos' => count(Elemento::whereHas('status',function($q){
					$q -> where('tipo','=','Activo');
					}) -> where('companiasysubzona_id','=',$compayzona->id) -> get()),
				'status' => $compayzona -> status,
				'tipo' => $compayzona -> tipo,
				);
		}
		return Response::json($companiasysubzonasArr);
	}

	public function postNombre()
	{
		$id = $_POST['id'];
		$compayzona = Companiasysubzona::find($id);
		$q = array(
			'nombre' => $compayzona -> nombre,
			'tipo' => 'Compania',
			'status' => $compayzona -> status,
			);
		return Response::json($q);
	}

	public function postCompania()
	{
		$arrayId = $_POST['id'];
		$q = array(
			'activos' 				=> 0,
			'inactivos' 			=> 0,
			'nuevos' 				=> 0,
			'hombres' 				=> 0,
			'mujeres' 				=> 0,
			'menorMasculino' 		=> 0,
			'juvenilMasculino' 		=> 0,
			'mayorMasculino' 		=> 0,
			'menorFemenino' 		=> 0,
			'juvenilFemenino' 		=> 0,
			'mayorFemenino' 		=> 0,
		);
		foreach ($arrayId as $id) {
			$data = ReportesController::reporteCompania($id);
			$q['activos']			+= $data['activos'];
			$q['inactivos']			+= $data['inactivos'];
			$q['nuevos']			+= $data['nuevos'];
			$q['hombres']			+= $data['hombres'];
			$q['mujeres']			+= $data['mujeres'];
			$q['menorMasculino']	+= $data['menorMasculino'];
			$q['juvenilMasculino']	+= $data['juvenilMasculino'];
			$q['mayorMasculino']	+= $data['mayorMasculino'];
			$q['menorFemenino']		+= $data['menorFemenino'];
			$q['juvenilFemenino']	+= $data['juvenilFemenino'];
			$q['mayorFemenino']		+= $data['mayorFemenino'];
		}
		return Response::json($q);
		// return Response::json($id[1]);
		// return Response::json($q);
	}

	private function reporteCompania($id)
	{
		$id = $id;
		$compayzona = Companiasysubzona::find($id);
		$elementos = Elemento::where('companiasysubzona_id','=',$compayzona->id)
			-> get();
		$activosArr = array();
		$inactivosArr = array();
		$nuevosArr = Array();
		foreach ($elementos as $elemento) {
			$tipo = $elemento -> status() -> orderBy('inicio','desc') -> first() -> tipo;
			if($tipo == 'Activo'){
				$activosArr[] = $elemento;
			}
			if($tipo == 'Inactivo'){
				$inactivosArr[] = $elemento;
			}
			if($tipo == 'Nuevo'){
				$nuevosArr[] = $elemento;
			}
		}
		$hombresArr = array();
		$mujeresArr = array();
		foreach ($activosArr as $activo) {
			$sexo = $activo -> persona -> sexo;
			if ($sexo == 'Masculino') {
				$hombresArr[] = $activo;
			}
			if ($sexo == 'Femenino') {
				$mujeresArr[] = $activo;
			}
		}
		$menorMasculino = array();
		$juvenilMasculino = array();
		$mayorMasculino = array();
		$menorFemenino = array();
		$juvenilFemenino = array();
		$mayorFemenino = array();
		foreach ($hombresArr as $hombre) {
			$edad = ReportesController::getAge($hombre -> fechanacimiento);
			if ($edad > 8 && $edad < 12) {
				$menorMasculino[] = $hombre;
			}
			if ($edad > 11 && $edad < 16) {
				$juvenilMasculino[] = $hombre;
			}
			if($edad > 15){
				$mayorMasculino[] = $hombre;
			}
		}
		foreach ($mujeresArr as $mujer) {
			$edad = ReportesController::getAge($mujer -> fechanacimiento);
			if ($edad > 8 && $edad < 12) {
				$menorFemenino[] = $mujer;
			}
			if ($edad > 11 && $edad < 16) {
				$juvenilFemenino[] = $mujer;
			}
			if($edad > 15){
				$mayorFemenino[] = $mujer;
			}		}
		$q = array(
			'activos' => count($activosArr),
			'inactivos' => count($inactivosArr),
			'nuevos' => count($nuevosArr),
			'hombres' => count($hombresArr),
			'mujeres' => count($mujeresArr),
			'menorMasculino' => count($menorMasculino),
			'juvenilMasculino' => count($juvenilMasculino),
			'mayorMasculino' => count($mayorMasculino),
			'menorFemenino' => count($menorFemenino),
			'juvenilFemenino' => count($juvenilFemenino),
			'mayorFemenino' => count($mayorFemenino),
			);
		return $q;
	}

	private function getAge($cumple)
	{
		$hoy = date("Y-m-d");
		$d1 = new DateTime( $cumple );
		$d2 = new DateTime($hoy );
		$age = $d2->diff( $d1 );
		return $age->y;
	}
}