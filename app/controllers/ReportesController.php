<?php
class ReportesController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('id','<',7)->where('id','>',1)->first()))
    	 		return "No Tienes acceso";
        });
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
		// $parametros = $_POST['parametros'];
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		// $sexo = $parametros['sexo'];
		$q = array();
		foreach ($arrayId as $id) {
			$q[] = ReportesController::reporteCompania($id);
		}
		return Response::json(ReportesController::busquedaAvanzada($inicio,$fin,$q));
	}

	public function busquedaAvanzada($inicio,$fin,$q)
	{
		$todas = array();
		foreach ($q as $elementos) {
			$sexoArr = array(
				'Masculino' => null,
				'Femenino' => null,
				);
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
				if (new DateTime($elemento['fecha']) > new DateTime($inicio) && new DateTime($elemento['fecha']) < new DateTime($fin)) {
					if ($elemento['sexo'] == 'Masculino') {
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
							$sexoArr['Masculino']['Menor']['recluta'] = $recluta;
							$sexoArr['Masculino']['Menor']['cadete'] = $cadeteInfanteria;
							$sexoArr['Masculino']['Menor']['cadete1'] = $cadete1;
							$sexoArr['Masculino']['Menor']['cabo'] = $cabo;
							$sexoArr['Masculino']['Menor']['sargento2'] = $sargento2;
							$sexoArr['Masculino']['Menor']['Sargento1'] = $sargento1;
							$sexoArr['Masculino']['Menor']['subOficial'] = $subOficial;
							$sexoArr['Masculino']['Menor']['Oficial1'] = $oficial3;
							$sexoArr['Masculino']['Menor']['Oficial2'] = $oficial2;
							$sexoArr['Masculino']['Menor']['Oficial3'] = $oficial1;
							$sexoArr['Masculino']['Menor']['Comandante1'] = $comandante3;
							$sexoArr['Masculino']['Menor']['Comandate2'] = $comandate2;
							$sexoArr['Masculino']['Menor']['Comandante3'] = $comandante1;
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
							$sexoArr['Masculino']['Juvenil']['recluta'] = $recluta_2;
							$sexoArr['Masculino']['Juvenil']['cadete'] = $cadeteInfanteria_2;
							$sexoArr['Masculino']['Juvenil']['cadete1'] = $cadete1_2;
							$sexoArr['Masculino']['Juvenil']['cabo'] = $cabo_2;
							$sexoArr['Masculino']['Juvenil']['sargento2'] = $sargento2_2;
							$sexoArr['Masculino']['Juvenil']['Sargento1'] = $sargento1_2;
							$sexoArr['Masculino']['Juvenil']['subOficial'] = $subOficial_2;
							$sexoArr['Masculino']['Juvenil']['Oficial1'] = $oficial3_2;
							$sexoArr['Masculino']['Juvenil']['Oficial2'] = $oficial2_2;
							$sexoArr['Masculino']['Juvenil']['Oficial3'] = $oficial1_2;
							$sexoArr['Masculino']['Juvenil']['Comandante1'] = $comandante3_2;
							$sexoArr['Masculino']['Juvenil']['Comandate2'] = $comandate2_2;
							$sexoArr['Masculino']['Juvenil']['Comandante3'] = $comandante1_2;
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
							$sexoArr['Masculino']['Mayor']['recluta'] = $recluta_3;
							$sexoArr['Masculino']['Mayor']['cadete'] = $cadeteInfanteria_3;
							$sexoArr['Masculino']['Mayor']['cadete1'] = $cadete1_3;
							$sexoArr['Masculino']['Mayor']['cabo'] = $cabo_3;
							$sexoArr['Masculino']['Mayor']['sargento2'] = $sargento2_3;
							$sexoArr['Masculino']['Mayor']['Sargento1'] = $sargento1_3;
							$sexoArr['Masculino']['Mayor']['subOficial'] = $subOficial_3;
							$sexoArr['Masculino']['Mayor']['Oficial1'] = $oficial3_3;
							$sexoArr['Masculino']['Mayor']['Oficial2'] = $oficial2_3;
							$sexoArr['Masculino']['Mayor']['Oficial3'] = $oficial1_3;
							$sexoArr['Masculino']['Mayor']['Comandante1'] = $comandante3_3;
							$sexoArr['Masculino']['Mayor']['Comandate2'] = $comandate2_3;
							$sexoArr['Masculino']['Mayor']['Comandante3'] = $comandante1_3;
						}
					}
					if ($elemento['sexo'] == 'Femenino') {
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
							$sexoArr['Femenino']['Menor']['recluta'] = $reclutaM;
							$sexoArr['Femenino']['Menor']['cadete'] = $cadeteInfanteriaM;
							$sexoArr['Femenino']['Menor']['cadete1'] = $cadete1M;
							$sexoArr['Femenino']['Menor']['cabo'] = $caboM;
							$sexoArr['Femenino']['Menor']['sargento2'] = $sargento2M;
							$sexoArr['Femenino']['Menor']['Sargento1'] = $sargento1M;
							$sexoArr['Femenino']['Menor']['subOficial'] = $subOficialM;
							$sexoArr['Femenino']['Menor']['Oficial1'] = $oficial3M;
							$sexoArr['Femenino']['Menor']['Oficial2'] = $oficial2M;
							$sexoArr['Femenino']['Menor']['Oficial3'] = $oficial1M;
							$sexoArr['Femenino']['Menor']['Comandante1'] = $comandante3M;
							$sexoArr['Femenino']['Menor']['Comandate2'] = $comandate2M;
							$sexoArr['Femenino']['Menor']['Comandante3'] = $comandante1M;
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
							$sexoArr['Femenino']['Juvenil']['recluta'] = $recluta_2M;
							$sexoArr['Femenino']['Juvenil']['cadete'] = $cadeteInfanteria_2M;
							$sexoArr['Femenino']['Juvenil']['cadete1'] = $cadete1_2M;
							$sexoArr['Femenino']['Juvenil']['cabo'] = $cabo_2M;
							$sexoArr['Femenino']['Juvenil']['sargento2'] = $sargento2_2M;
							$sexoArr['Femenino']['Juvenil']['Sargento1'] = $sargento1_2M;
							$sexoArr['Femenino']['Juvenil']['subOficial'] = $subOficial_2M;
							$sexoArr['Femenino']['Juvenil']['Oficial1'] = $oficial3_2M;
							$sexoArr['Femenino']['Juvenil']['Oficial2'] = $oficial2_2M;
							$sexoArr['Femenino']['Juvenil']['Oficial3'] = $oficial1_2M;
							$sexoArr['Femenino']['Juvenil']['Comandante1'] = $comandante3_2M;
							$sexoArr['Femenino']['Juvenil']['Comandate2'] = $comandate2_2M;
							$sexoArr['Femenino']['Juvenil']['Comandante3'] = $comandante1_2M;
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
							$sexoArr['Femenino']['Mayor']['recluta'] = $recluta_3M;
							$sexoArr['Femenino']['Mayor']['cadete'] = $cadeteInfanteria_3M;
							$sexoArr['Femenino']['Mayor']['cadete1'] = $cadete1_3M;
							$sexoArr['Femenino']['Mayor']['cabo'] = $cabo_3M;
							$sexoArr['Femenino']['Mayor']['sargento2'] = $sargento2_3M;
							$sexoArr['Femenino']['Mayor']['Sargento1'] = $sargento1_3M;
							$sexoArr['Femenino']['Mayor']['subOficial'] = $subOficial_3M;
							$sexoArr['Femenino']['Mayor']['Oficial1'] = $oficial3_3M;
							$sexoArr['Femenino']['Mayor']['Oficial2'] = $oficial2_3M;
							$sexoArr['Femenino']['Mayor']['Oficial3'] = $oficial1_3M;
							$sexoArr['Femenino']['Mayor']['Comandante1'] = $comandante3_3M;
							$sexoArr['Femenino']['Mayor']['Comandate2'] = $comandate2_3M;
							$sexoArr['Femenino']['Mayor']['Comandante3'] = $comandante1_3M;
						}
					}
				}
			}
			$todas[]=$sexoArr;
		}
		return ($todas);
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