<?php

class MembresiasController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('hacienda');
    }

	public function getIndex(){
		return View::make('pagos/pagos');
	}

	public function getDonativos(){
		return View::make('pagos/donativos');
	}

	public function getReportes(){
		return View::make('pagos.reportes');
	}

	public function postReportes(){
		$inicio = new DateTime($_POST['i']);
		$fin = new DateTime($_POST['f']);
		$membresia = $_POST['mem'];
		$credencial = $_POST['cre'];
		$evento = $_POST['eve'];
		$examen = $_POST['exa'];
		$donativo = $_POST['don'];
		$pagos = Pago::where('fecha','>=',$inicio)
					-> where('fecha','<=',$fin)
					-> get();
		$pagosArr = array();
		foreach ($pagos as $pago) {
				if (strpos($pago -> concepto, $membresia) === 0 || $pago -> concepto == $credencial || strpos($pago -> concepto, $evento) === 0 || strpos($pago -> concepto, $examen) === 0 || $pago -> concepto == $donativo) {
					$pagosArr[] = array($pago->concepto,$pago->fecha,$pago->cantidad);
				}
		}
		return Response::json($pagosArr);
	}

	public function getMembresias(){
		return View::make('pagos.membresias');
	}

	public function postMembresias(){
		$inicio = new DateTime($_POST['i']);
		$fin = new DateTime($_POST['f']);
		$data = array();
		$pagos = Pago::where('concepto','like','Membresia'.'%') -> where('fecha','>=',$inicio) -> where('fecha','<=',$fin) -> get();
		foreach ($pagos as $pago) {
			$data[] = array(
				$pago -> elemento -> persona -> nombre,
				$pago -> elemento -> persona -> apellidopaterno,
				$pago -> elemento -> persona -> apellidomaterno,
				$pago -> concepto,
				$pago -> fecha,
				$pago -> elemento -> companiasysubzona -> nombre,
				$pago -> elemento -> grados -> last() -> nombre,
				);
		}
		return Response::json($data);
	}

	public function postSinentero()
	{
		$anio = date('Y');
		$elementos = Elemento::all();
		$no = array();
		foreach ($elementos as $elemento) {
			if(is_null($elemento -> pagos() ->where('concepto','like','Membresia '.$anio) -> first())){
				$matricula = 'No tiene matrícula';
				if(!is_null($elemento -> matricula ))
					$matricula = $elemento -> matricula -> id;
				$no[] = array(
						$elemento -> persona -> nombre,
						$elemento -> persona -> apellidopaterno,
						$elemento -> persona -> apellidomaterno,
						$matricula,
						'Sin registro de entero '.$anio,
						$elemento -> grados -> last() -> nombre,
						$elemento -> companiasysubzona -> nombre,
					);
				}
		}
		return Response::json($no);
	}

	public function getImprimir(){
		$hacienda = Cargo::find(2)->elementos()->where('fecha_fin','=',null)->first();
		if(is_null($hacienda)){
			$nombrehacienda		=	"";
		}
		else{
			$nombrehacienda		=	$hacienda->persona->nombre.' '.
									$hacienda->persona->apellidopaterno.' '.
									$hacienda->persona->apellidomaterno;
		}
		$pdf = App::make('dompdf');
		$html = View::make('pagos/recibodonativo2')
		->with('inicio',1)->with('fin',5)->with('hacienda',$nombrehacienda);
		$pdf->loadHTML($html);
		return $pdf->stream();
	}
	public function postDonativos(){
		$donativo = Donativo::create(array(
			'nombre' 	=> Input::get('nombre'),
			'paterno' 	=> Input::get('paterno'),
			'materno' 	=> Input::get('materno'),
			'donativo' 	=> Input::get('donativo'),
			'fecha' 	=> date('Y-m-d'),
		));
		$pdf = App::make('dompdf');
		$pdf->loadHTML(MembresiasController::viewDonativo($donativo));
		return $pdf->stream();
	}

	public function postElemento(){
		$elemento = Elemento::find(Input::get('id'));
		$matricula = $elemento->matricula;
			$nummatricula="";
			if (!is_null($matricula)) {
				$nummatricula = $matricula->id;
			}
		$dato = array(
			'nombre'	=> $elemento->persona->nombre.' '.$elemento->persona->apellidopaterno.' '.$elemento->persona->apellidomaterno,
			'fecha'		=> $elemento->fechanacimiento,
			'matricula' => $nummatricula,
			'foto'		=> $elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta,
			'grado'		=> $elemento->grados()->orderBy('fecha','desc')->first()->nombre,
			'compania'	=> $elemento->companiasysubzona->tipo." ".$elemento->companiasysubzona->nombre
			);
			return Response::json($dato);
	}

	public function postRegistrarpago(){
		$rules = array(
			'id' 		=> 'required|integer|exists:elementos',
			'cantidad' 	=> 'numeric',
			'tipo'		=> 'required'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation -> fails())
		{
			$dato = array('success' => false,
				'errormessage' => '<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		////////////////////////////
		if (Input::get('tipo') == 'Credencial') {
			return Response::json(MembresiasController::pago(Input::get('id'),Input::get('cantidad'),Input::get('tipo')));
		}
		if (Input::get('tipo') == 'Donativo') {
			$donativo = Donativo::create(array(
				'nombre' 	=> Elemento::find(Input::get('id'))->persona->nombre,
				'paterno' 	=> Elemento::find(Input::get('id'))->persona->apellidopaterno,
				'materno' 	=> Elemento::find(Input::get('id'))->persona->apellidomaterno,
				'donativo' 	=> Input::get('cantidad'),
				'fecha' 	=> date('Y-m-d'),
			));
			$datos = MembresiasController::pago(Input::get('id'),Input::get('cantidad'),Input::get('tipo'));
			$pdf = App::make('dompdf');
			$pdf->loadHTML(MembresiasController::viewDonativo($donativo));
			return $pdf->stream();
		}
		if (Input::get('tipo') == 'Evento') {
			if(!is_null(Evento::find(Input::get('concepto'))->elementos()->where('elemento_id','=',Input::get('id'))->first())){
				$dato = array(
					'success' 	=> false,
					'errormessage' 	=> 'El entero ya se registro anteriormente',
					);
				return Response::json($dato);
			}
			$dato = MembresiasController::pago(Input::get('id'),Evento::find(Input::get('concepto'))->precio,Input::get('tipo')." ".Evento::find(Input::get('concepto'))->nombre);

			$elemento = Elemento::find(Input::get('id'));
			$elemento->eventos()->attach(Input::get('concepto'));
		
		return Response::json($dato);
		}
		if (Input::get('tipo') == 'Examen') {

			$elemento = Elemento::find(Input::get('id'));

			if(is_null(Elemento::find(Input::get('id'))->examenes()
				->where('examen_id','=',Input::get('concepto'))->first())){

				$elemento->examenes()->attach(Input::get('concepto'));
				$dato = MembresiasController::pago(Input::get('id'),
					Examen::find(Input::get('concepto'))->precio,
					Input::get('tipo')." ".Examen::find(Input::get('concepto'))->nombre);
			}
			else if(6 > Elemento::find(Input::get('id'))->examenes()->where('examen_id','=',Input::get('concepto'))->first()->pivot->calificacion
					&& !is_null(Elemento::find(Input::get('id'))->examenes()
						->where('examen_id','=',Input::get('concepto'))->first()->pivot->calificacion)
					){
				$elemento->examenes()->updateExistingPivot(
					Input::get('concepto'),
					array(
						'fecha' 		=> null,
						'calificacion' 	=> null
						)
					);
				$dato = MembresiasController::pago(Input::get('id'),
						Examen::find(Input::get('concepto'))->precio,
						Input::get('tipo')." ".Examen::find(Input::get('concepto'))->nombre);
			}
			else
				$dato = array(
					'success' 	=> false,
					'errormessage' 	=> 'El entero ya se registro anteriormente',
					);
		
		return Response::json($dato);
		}
		////////////////////////////
		$pagos = Pago::where('elemento_id','=',Input::get('id'),'and')
				->where('fecha','like',date("Y").'%','and')
				->where('concepto','like','Membresia%')->first();

		if(is_null($pagos)){
			$matricula = Elemento::find(Input::get('id'))->matricula;
			if(is_null($matricula)){
				$nummatricula = MembresiasController::calcula_matricula();
				$matricula = new Matricula;
					$matricula->elemento_id = Input::get('id');
					$matricula->id = $nummatricula;
				$matricula->save();
			}
				$dato = MembresiasController::pago(Input::get('id'),Input::get('cantidad'),"Membresia ".date("Y"));
				$dato['matricula'] = '<strong>'.$matricula->id.'</strong>';
				$dato['message'] = 'El entero se a registrado exitosamente numero de Matricula: ';
				$dato['asd'] = $nummatricula;
		}
		else
			$dato = array('success' => false,
				'errormessage' 		=> 'El entero ya se fue registrado el <strong>'.date("d/m/Y",strtotime($pagos->fecha)).'</strong>'
				);

		return Response::json($dato);
	}

	public function postRecibo(){
		$rules = array(
			'id' => 'required|integer|exists:pagos'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{
			return Redirect::back()->with('status', 'fail_create');
		}

		$pago = Pago::find(Input::get('id'));
		$hacienda = Cargo::find(2)->elementos()->where('fecha_fin','=',null)->first();
		if(is_null($hacienda)){
			$nombrehacienda		=	"";
			$gradohacienda		=	"";
		}
		else{
			$nombrehacienda		=	$hacienda->persona->nombre.' '.
									$hacienda->persona->apellidopaterno.' '.
									$hacienda->persona->apellidomaterno;
			$gradohacienda		=	$hacienda->grados()->orderBy('fecha','desc')
									->first()->nombre;
		}

		if(!is_null($pago)){
			$datos = array(
				'name' 			=>  $pago->elemento->persona->nombre.' '.
							 		$pago->elemento->persona->apellidopaterno.' '.
							  		$pago->elemento->persona->apellidomaterno,
				'grado' 		=>  $pago->elemento->grados()->orderBy('fecha','desc')
									->first()->nombre,
				'reclutamiento' =>  $pago->elemento->reclutamiento,
				'matricula'		=>	$pago->elemento->matricula,
				'fecha' 		=>  $pago->fecha,
				'cantidad'		=>	$pago->cantidad,
				'zona' 			=> 	$pago->elemento->companiasysubzona->nombre,
				'hacienda' 		=>  $nombrehacienda,
				'gradohacienda' => 	$gradohacienda,
				'folio'			=>	$pago->id,
				'concepto'		=>  $pago->concepto,
				);
			$html = View::make('pagos/recibomembrecia')->with('datos',$datos);
		}
		else
		//return View::make('pagos/recibomembrecia');
		$html =  View::make('pagos/recibomembrecia'); 

		$pdf = App::make('dompdf');
		$pdf->loadHTML($html);
		return $pdf->stream();
	}

	public function pago($elemento,$cantidad,$concepto){
		$pago = new Pago;
					$pago->elemento_id = $elemento;
					$pago->concepto = $concepto;
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = $cantidad;
				$pago->save();
				$dato = array(
					'success' 	=> true,
					'matricula' => '',
					'message' 	=> 'El entero se a registrado exitosamente',
					'pago' 		=> $pago->id
					);
		return $dato;
	}
	public function viewDonativo($donativo){
		$hacienda = Cargo::find(2)->elementos()->where('fecha_fin','=',null)->first();
			if(is_null($hacienda)){
				$nombrehacienda		=	"";
				$gradohacienda		=	"";
			}
			else{
				$nombrehacienda		=	$hacienda->persona->nombre.' '.
										$hacienda->persona->apellidopaterno.' '.
										$hacienda->persona->apellidomaterno;
				$gradohacienda		=	$hacienda->grados()->orderBy('fecha','desc')
										->first()->nombre;
			}
			$datos = array(
					'name' 			=>  $donativo->nombre.' '.
								 		$donativo->paterno.' '.
								  		$donativo->materno,
					'fecha' 		=>  $donativo->fecha,
					'cantidad'		=>	$donativo->donativo,
					'hacienda' 		=>  $nombrehacienda,
					'gradohacienda' => 	$gradohacienda,
					'folio'			=>	$donativo->id,
					'concepto'		=>  "Donativo",
					);
			$html = View::make('pagos/recibodonativo')->with('datos',$datos);
			return $html;
	}

	public function calcula_matricula(){
		$matricula = '20';
		$matricula .= date('y');
		$reclutamiento = 40 + ((date('Y') - 2013) * 2);
		if(date('m') > 6)
			$reclutamiento++;
		$matricula .= $reclutamiento;
		$last = Matricula::where('id','>',$matricula.'000','and')->where('id','<',$matricula.'999')->orderBy('id','desc')->first();
		if(is_null($last))
			return $matricula .= '001';
		else{
			return ($last->id)+1;
		}

	}
}