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
		$id = $_POST['id'];
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
			if ($sexo == 'Hombre') {
				$hombresArr[] = $activo;
			}
			if ($sexo == 'Mujer') {
				$mujeresArr[] = $activo;
			}
		}
		$menorMasculino = array();
		$juvenilMasculino = array();
		$mayorMasculino = array();
		$menorFemenino = array();
		$juvenilFemenino = array();
		$mayorFemenino = array();
		$dob = "14-12-1990";
		$tdate = date("Y-m-d");
		$prueba = ReportesController::getAge( $dob, $tdate );
		foreach ($hombresArr as $hombre) {
		}
		foreach ($mujeresArr as $mujer) {
			# code...
		}
		$q = array(
			'a' => $prueba,
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
		return Response::json($q);
	}
	function getAge( $nacimiento, $tdate )
	{
		$nacimiento = new DateTime( $nacimiento );
		$age = 0;
		$now = new DateTime( $tdate );
		while( $nacimiento->add( new DateInterval('P1Y') ) < $now ){
			$age++;
		}
		return $age;
	}
}