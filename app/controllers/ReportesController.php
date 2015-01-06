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
}