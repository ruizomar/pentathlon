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
		$activos =  Elemento::whereHas('status',function($q){
				$q -> where('tipo','=','Activo');})
			-> where('companiasysubzona_id','=',$compayzona->id)
			-> get();
		$hombres =  Elemento::whereHas('status',function($q){
				$q -> where('tipo','=','Activo');})
			-> where('companiasysubzona_id','=',$compayzona->id) -> whereHas('persona',function ($qq){
				$qq -> where('sexo','=','Hombre');})
			-> get();
		$mujeres =  Elemento::whereHas('status',function($q){
				$q -> where('tipo','=','Activo');})
			-> where('companiasysubzona_id','=',$compayzona->id) -> whereHas('persona',function ($qq){
				$qq -> where('sexo','=','Mujer');})
			-> get();
		$q = array(
			'activos' => count($activos),
			'inactivos' => $activos,
			'menorMasculino' => '3',
			'juvenilMasculino' => '23',
			'mayorMasculino' => '34',
			'menorFemenino' => '12',
			'juvenilFemenino' => '34',
			'mayorFemenino' => '29',
			);
		return Response::json($q);
	}
}