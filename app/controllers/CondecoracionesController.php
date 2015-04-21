<?php 
class CondecoracionesController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('tecnica');
    }
	public function getIndex(){
		return View::make('condecoraciones/condecoraciones');
	}

	public function postElemento(){
		$data = array();
		$elemento = Elemento::find(Input::get('id'));
		$matricula = $elemento->matricula;
			$nummatricula="sin asignar";
			if (!is_null($matricula)) {
				$nummatricula = $matricula->id;
			}
		$data['persona'] = array(
			'nombre' 	=> $elemento->persona->nombre.' '.$elemento->persona->apellidopaterno.' '.$elemento->persona->apellidomaterno,
			'matricula' => $nummatricula,
			'fecha' 	=> $elemento->fechanacimiento,
			'foto'		=> $elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta
		 );
		$condecoraciones = $elemento->reconocimientos()
									->where('nombre','like','condecoracion%')
									->orderBy('fecha','asc')
									->get();
		if(count($condecoraciones) == 0)
			$data['success'] =	false;				
			$data['condecoraciones'] = $condecoraciones;
		return Response::json($data);						
	}
	public function postNueva(){
		$estatus = Elemento::find(Input::get('id'))->status()->orderBy('inicio','desc')->get();

		$d1 = date_create(date('Y-m-d'));
		$tiempo = 0;
		foreach ($estatus as $estatu) {
			$d2 = date_create($estatu->inicio);
			if($estatu->tipo == 'Activo'){
				$interval = date_diff($d1, $d2);
				$tiempo = (int) $interval->format('%a');
			}
			else
				$d1 = date_create(date('Y-m-d',strtotime ( '+'.$tiempo.' day' , strtotime( $estatu->inicio) )));		
		}
		$tiempo = (int)($tiempo/365);
		$conde = array();
		for ($i=5; $i < 100; $i=$i+5) {
			$condecoraciones = Elemento::find(Input::get('id'))->reconocimientos()
									->where('nombre','=',"condecoracion por ".$i." años")
									->orderBy('fecha','asc')
									->first();
			if($tiempo >= $i && is_null($condecoraciones)){
					$conde[] = $i; 
				}	
		}
		if(count($conde) == 0)
			$conde['success'] =	false;
		return Response::json($conde);
	}
	public function postAgregar(){
		$elemento = Elemento::find(Input::get('id'));
		$condecoraciones=array();
		foreach (Input::all() as $key => $value) {
			if(is_numeric($key))
				$condecoraciones[] = $elemento->reconocimientos()
				->save(new Reconocimiento(array(
						'nombre' => 'Condecoración por '.$key.' años',
						'fecha' => date('Y-m-d'),)
				));
		}
		return Response::json(array('success' => true,
			'condecoraciones' => $condecoraciones));
	}
	public function postImprimir(){
		$pdf = App::make('dompdf');
		$comandante = Cargo::find(9)->elementos()->where('fecha_fin','=',null)->first();
		$html = View::make('condecoraciones/reconocimiento')
		->with('condecoraciones',Input::all())->with('comandante',$comandante);
		$pdf->loadHTML($html)->setPaper('a4')->setOrientation('landscape');
		return $pdf->stream();
	}
}