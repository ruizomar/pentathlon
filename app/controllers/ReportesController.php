<?php
class ReportesController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
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
				'nombre' => $compayzona->nombre,
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
		$parametros = $_POST['parametros'];
		$fechas = $parametros['fechas'];
		$sexo = $parametros['sexo'];
		$edad = $parametros['edad'];
		$grado = $parametros['grado'];
		$q = array();
		foreach ($arrayId as $id) {
			$q[] = ReportesController::reporteCompania($id);
		}
		// return Response::json($q);
		return Response::json(ReportesController::busquedaAvanzada($fechas,$sexo,$edad,$grado,$q));
	}

	public function busquedaAvanzada($fechas,$sexo,$edad,$grado,$q)
	{
		$sexoArr = array(
			'Masculino' => null,
			'Femenino' => null,
			);
		foreach ($q as $elementos) {
			$recluta = array();
			$cadeteInfanteria = array();
			$cadete1 = array();
			$cabo = array();
			$sargento2 = array();
			$sargento1 = array();
			$subOficial = array();
			$oficial3 = array();
			$oficial2 = array();
			$oficial1 = array();
			$comandante3 = array();
			$comandate2 = array();
			$comandante1 = array();

			$recluta_2 = array();
			$cadeteInfanteria_2 = array();
			$cadete1_2 = array();
			$cabo_2 = array();
			$sargento2_2 = array();
			$sargento1_2 = array();
			$subOficial_2 = array();
			$oficial3_2 = array();
			$oficial2_2 = array();
			$oficial1_2 = array();
			$comandante3_2 = array();
			$comandate2_2 = array();
			$comandante1_2 = array();

			$recluta_3 = array();
			$cadeteInfanteria_3 = array();
			$cadete1_3 = array();
			$cabo_3 = array();
			$sargento2_3 = array();
			$sargento1_3 = array();
			$subOficial_3 = array();
			$oficial3_3 = array();
			$oficial2_3 = array();
			$oficial1_3 = array();
			$comandante3_3 = array();
			$comandate2_3 = array();
			$comandante1_3 = array();

			$reclutaM = array();
			$cadeteInfanteriaM = array();
			$cadete1M = array();
			$caboM = array();
			$sargento2M = array();
			$sargento1M = array();
			$subOficialM = array();
			$oficial3M = array();
			$oficial2M = array();
			$oficial1M = array();
			$comandante3M = array();
			$comandate2M = array();
			$comandante1M = array();

			$recluta_2M = array();
			$cadeteInfanteria_2M = array();
			$cadete1_2M = array();
			$cabo_2M = array();
			$sargento2_2M = array();
			$sargento1_2M = array();
			$subOficial_2M = array();
			$oficial3_2M = array();
			$oficial2_2M = array();
			$oficial1_2M = array();
			$comandante3_2M = array();
			$comandate2_2M = array();
			$comandante1_2M = array();

			$recluta_3M = array();
			$cadeteInfanteria_3M = array();
			$cadete1_3M = array();
			$cabo_3M = array();
			$sargento2_3M = array();
			$sargento1_3M = array();
			$subOficial_3M = array();
			$oficial3_3M = array();
			$oficial2_3M = array();
			$oficial1_3M = array();
			$comandante3_3M = array();
			$comandate2_3M = array();
			$comandante1_3M = array();
			foreach ($elementos as $elemento) {
				if (condition) {
					if ($elemento['sexo'] == $sexo[1]) {
						if($elemento['edad'] > 8 && $elemento['edad'] < 12){
							if ($elemento['grado_id'] == 1) {
								$recluta[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteria[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$cabo[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficial[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1[] = $elemento;
							}
							$sexoArr['Masculino']['Menor']['Recluta'] = $recluta;
							$sexoArr['Masculino']['Menor']['Cadete de infanteria'] = $cadeteInfanteria;
							$sexoArr['Masculino']['Menor']['Cadete 1a'] = $cadete1;
							$sexoArr['Masculino']['Menor']['Cabo'] = $cabo;
							$sexoArr['Masculino']['Menor']['Sargento 2'] = $sargento2;
							$sexoArr['Masculino']['Menor']['Sargento 1'] = $sargento1;
							$sexoArr['Masculino']['Menor']['Sub Oficial'] = $subOficial;
							$sexoArr['Masculino']['Menor']['3 Oficial'] = $oficial3;
							$sexoArr['Masculino']['Menor']['2 Oficial'] = $oficial2;
							$sexoArr['Masculino']['Menor']['1 Oficial'] = $oficial1;
							$sexoArr['Masculino']['Menor']['3 Comandante'] = $comandante3;
							$sexoArr['Masculino']['Menor']['2 Comandate'] = $comandate2;
							$sexoArr['Masculino']['Menor']['1 Comandante'] = $comandante1;
						}
						if($elemento['edad'] > 11 && $elemento['edad'] < 16){
							if ($elemento['grado_id'] == 1) {
								$recluta_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteria_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$cabo_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficial_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2_2[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1_2[] = $elemento;
							}
							$sexoArr['Masculino']['Juvenil']['Recluta'] = $recluta_2;
							$sexoArr['Masculino']['Juvenil']['Cadete de infanteria'] = $cadeteInfanteria_2;
							$sexoArr['Masculino']['Juvenil']['Cadete 1a'] = $cadete1_2;
							$sexoArr['Masculino']['Juvenil']['Cabo'] = $cabo_2;
							$sexoArr['Masculino']['Juvenil']['Sargento 2'] = $sargento2_2;
							$sexoArr['Masculino']['Juvenil']['Sargento 1'] = $sargento1_2;
							$sexoArr['Masculino']['Juvenil']['Sub Oficial'] = $subOficial_2;
							$sexoArr['Masculino']['Juvenil']['3 Oficial'] = $oficial3_2;
							$sexoArr['Masculino']['Juvenil']['2 Oficial'] = $oficial2_2;
							$sexoArr['Masculino']['Juvenil']['1 Oficial'] = $oficial1_2;
							$sexoArr['Masculino']['Juvenil']['3 Comandante'] = $comandante3_2;
							$sexoArr['Masculino']['Juvenil']['2 Comandate'] = $comandate2_2;
							$sexoArr['Masculino']['Juvenil']['1 Comandante'] = $comandante1_2;
						}
						if($elemento['edad'] > 15){
							if ($elemento['grado_id'] == 1) {
								$recluta_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteria_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$cabo_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficial_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2_3[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1_3[] = $elemento;
							}
							$sexoArr['Masculino']['Mayor']['Recluta'] = $recluta_3;
							$sexoArr['Masculino']['Mayor']['Cadete de infanteria'] = $cadeteInfanteria_3;
							$sexoArr['Masculino']['Mayor']['Cadete 1a'] = $cadete1_3;
							$sexoArr['Masculino']['Mayor']['Cabo'] = $cabo_3;
							$sexoArr['Masculino']['Mayor']['Sargento 2'] = $sargento2_3;
							$sexoArr['Masculino']['Mayor']['Sargento 1'] = $sargento1_3;
							$sexoArr['Masculino']['Mayor']['Sub Oficial'] = $subOficial_3;
							$sexoArr['Masculino']['Mayor']['3 Oficial'] = $oficial3_3;
							$sexoArr['Masculino']['Mayor']['2 Oficial'] = $oficial2_3;
							$sexoArr['Masculino']['Mayor']['1 Oficial'] = $oficial1_3;
							$sexoArr['Masculino']['Mayor']['3 Comandante'] = $comandante3_3;
							$sexoArr['Masculino']['Mayor']['2 Comandate'] = $comandate2_3;
							$sexoArr['Masculino']['Mayor']['1 Comandante'] = $comandante1_3;
						}
					}
					if ($elemento['sexo'] == $sexo[2]) {
						if($elemento['edad'] > 8 && $elemento['edad'] < 12){
							if ($elemento['grado_id'] == 1) {
								$reclutaM[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteriaM[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1M[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$caboM[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1M[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficialM[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1M[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1M[] = $elemento;
							}
							$sexoArr['Femenino']['Menor']['Recluta'] = $reclutaM;
							$sexoArr['Femenino']['Menor']['Cadete de infanteria'] = $cadeteInfanteriaM;
							$sexoArr['Femenino']['Menor']['Cadete 1a'] = $cadete1M;
							$sexoArr['Femenino']['Menor']['Cabo'] = $caboM;
							$sexoArr['Femenino']['Menor']['Sargento 2'] = $sargento2M;
							$sexoArr['Femenino']['Menor']['Sargento 1'] = $sargento1M;
							$sexoArr['Femenino']['Menor']['Sub Oficial'] = $subOficialM;
							$sexoArr['Femenino']['Menor']['3 Oficial'] = $oficial3M;
							$sexoArr['Femenino']['Menor']['2 Oficial'] = $oficial2M;
							$sexoArr['Femenino']['Menor']['1 Oficial'] = $oficial1M;
							$sexoArr['Femenino']['Menor']['3 Comandante'] = $comandante3M;
							$sexoArr['Femenino']['Menor']['2 Comandate'] = $comandate2M;
							$sexoArr['Femenino']['Menor']['1 Comandante'] = $comandante1M;
						}
						if($elemento['edad'] > 11 && $elemento['edad'] < 16){
							if ($elemento['grado_id'] == 1) {
								$recluta_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteria_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$cabo_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficial_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2_2M[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1_2M[] = $elemento;
							}
							$sexoArr['Femenino']['Juvenil']['Recluta'] = $recluta_2M;
							$sexoArr['Femenino']['Juvenil']['Cadete de infanteria'] = $cadeteInfanteria_2M;
							$sexoArr['Femenino']['Juvenil']['Cadete 1a'] = $cadete1_2M;
							$sexoArr['Femenino']['Juvenil']['Cabo'] = $cabo_2M;
							$sexoArr['Femenino']['Juvenil']['Sargento 2'] = $sargento2_2M;
							$sexoArr['Femenino']['Juvenil']['Sargento 1'] = $sargento1_2M;
							$sexoArr['Femenino']['Juvenil']['Sub Oficial'] = $subOficial_2M;
							$sexoArr['Femenino']['Juvenil']['3 Oficial'] = $oficial3_2M;
							$sexoArr['Femenino']['Juvenil']['2 Oficial'] = $oficial2_2M;
							$sexoArr['Femenino']['Juvenil']['1 Oficial'] = $oficial1_2M;
							$sexoArr['Femenino']['Juvenil']['3 Comandante'] = $comandante3_2M;
							$sexoArr['Femenino']['Juvenil']['2 Comandate'] = $comandate2_2M;
							$sexoArr['Femenino']['Juvenil']['1 Comandante'] = $comandante1_2M;
						}
						if($elemento['edad'] > 15){
							if ($elemento['grado_id'] == 1) {
								$recluta_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 2) {
								$cadeteInfanteria_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 3) {
								$cadete1_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 4) {
								$cabo_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 5) {
								$sargento2_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 6) {
								$sargento1_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 7) {
								$subOficial_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 8) {
								$oficial3_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 9) {
								$oficial2_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 10) {
								$oficial1_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 11) {
								$comandante3_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 12) {
								$comandate2_3M[] = $elemento;
							}
							if ($elemento['grado_id'] == 13) {
								$comandante1_3M[] = $elemento;
							}
							$sexoArr['Femenino']['Mayor']['Recluta'] = $recluta_3M;
							$sexoArr['Femenino']['Mayor']['Cadete de infanteria'] = $cadeteInfanteria_3M;
							$sexoArr['Femenino']['Mayor']['Cadete 1a'] = $cadete1_3M;
							$sexoArr['Femenino']['Mayor']['Cabo'] = $cabo_3M;
							$sexoArr['Femenino']['Mayor']['Sargento 2'] = $sargento2_3M;
							$sexoArr['Femenino']['Mayor']['Sargento 1'] = $sargento1_3M;
							$sexoArr['Femenino']['Mayor']['Sub Oficial'] = $subOficial_3M;
							$sexoArr['Femenino']['Mayor']['3 Oficial'] = $oficial3_3M;
							$sexoArr['Femenino']['Mayor']['2 Oficial'] = $oficial2_3M;
							$sexoArr['Femenino']['Mayor']['1 Oficial'] = $oficial1_3M;
							$sexoArr['Femenino']['Mayor']['3 Comandante'] = $comandante3_3M;
							$sexoArr['Femenino']['Mayor']['2 Comandate'] = $comandate2_3M;
							$sexoArr['Femenino']['Mayor']['1 Comandante'] = $comandante1_3M;
						}
					}
				}
			}
		}
		return ($sexoArr);
	}

	public function datosElemento($elemento)
	{
		$grado = $elemento -> grados -> last();
		$arraPersonas = array(
			'nombre' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'matricula' => $elemento -> matricula -> id,
			'grado_id' => $grado -> id,
			'grado' => $grado -> nombre,
			'fecha' => $grado -> pivot -> fecha,
			'sexo' => $elemento -> persona -> sexo,
			'edad' => ReportesController::getAge($elemento -> fechanacimiento),
			'zona' => $elemento -> companiasysubzona -> nombre,
			);
		return $arraPersonas;
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
		$elementosArr = array();
		foreach ($activosArr as $elemento) {
			$elementosArr[] =  ReportesController::datosElemento($elemento);
		}
		return $elementosArr;
		// $hombresArr = array();
		// $mujeresArr = array();
		// foreach ($activosArr as $activo) {
		// 	$sexo = $activo -> persona -> sexo;
		// 	if ($sexo == 'Masculino') {
		// 		$hombresArr[] = $activo;
		// 	}
		// 	if ($sexo == 'Femenino') {
		// 		$mujeresArr[] = $activo;
		// 	}
		// }
		// $menorMasculino = array();
		// $juvenilMasculino = array();
		// $mayorMasculino = array();
		// $menorFemenino = array();
		// $juvenilFemenino = array();
		// $mayorFemenino = array();
		// foreach ($hombresArr as $hombre) {
		// 	$edad = ReportesController::getAge($hombre -> fechanacimiento);
		// 	if ($edad > 8 && $edad < 12) {
		// 		$menorMasculino[] = $hombre;
		// 	}
		// 	if ($edad > 11 && $edad < 16) {
		// 		$juvenilMasculino[] = $hombre;
		// 	}
		// 	if($edad > 15){
		// 		$mayorMasculino[] = $hombre;
		// 	}
		// }
		// foreach ($mujeresArr as $mujer) {
		// 	$edad = ReportesController::getAge($mujer -> fechanacimiento);
		// 	if ($edad > 8 && $edad < 12) {
		// 		$menorFemenino[] = $mujer;
		// 	}
		// 	if ($edad > 11 && $edad < 16) {
		// 		$juvenilFemenino[] = $mujer;
		// 	}
		// 	if($edad > 15){
		// 		$mayorFemenino[] = $mujer;
		// 	}		}
		// $q = array(
		// 	'activos' => count($activosArr),
		// 	'inactivos' => count($inactivosArr),
		// 	'nuevos' => count($nuevosArr),
		// 	'hombres' => count($hombresArr),
		// 	'mujeres' => count($mujeresArr),
		// 	'menorMasculino' => count($menorMasculino),
		// 	'juvenilMasculino' => count($juvenilMasculino),
		// 	'mayorMasculino' => count($mayorMasculino),
		// 	'menorFemenino' => count($menorFemenino),
		// 	'juvenilFemenino' => count($juvenilFemenino),
		// 	'mayorFemenino' => count($mayorFemenino),
		// 	'nombre' => $compayzona -> nombre,
		// 	);
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