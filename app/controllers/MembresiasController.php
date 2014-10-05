<?php

class MembresiasController extends BaseController {

	public function getIndex(){
		/*$elemento = Elemento::whereHas('persona',function($q){ 
			$q->where('nombre','like','eliel'.'%')
			->where('apellidopaterno','=','nava')
			->where('apellidomaterno','like',''.'%');
		})->get();
		//$we = array('omar' => array('er' => "chas") );
		//$we['omar'] = array('er' => "chas");
		$dato = array();
		foreach ($elemento as $elemento) {
			 $dato[] = array(
			 	'id' => $elemento->id,
			 	'nombre' => $elemento->persona->nombre,
			 	'apellidopaterno' => $elemento->persona->apellidopaterno,
			 	'apellidomaterno' => $elemento->persona->apellidomaterno,
			 	'fecha' => $elemento->fechanacimiento,
			 	'matricula' => $elemento->matricula,
			 	);
		}
		return Response::json($dato);*/
		//print_r ( $dato );
		return View::make('pagos/index');
	}

	public function postBuscar(){
		$rules = array(
			'nombre' => 'required|alpha',
			'paterno' => 'required|alpha',
			'materno' => 'alpha'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  $dato = array('success' => false,'errormessage' => '<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');

		$elemento = Elemento::whereHas('persona',function($q) use ($nombre,$paterno,$materno){ 
			$q->where('nombre','like',$nombre.'%')
			->where('apellidopaterno','=',$paterno)
			->where('apellidomaterno','like',$materno.'%');
		})->get();

		if(count($elemento) == 1){
			$elemento = $elemento->first();
			$matricula = $elemento->matricula;
				$nummatricula = "";
				if(!is_null($matricula))
					$nummatricula = $matricula->matricula;
				$dato = array(
		            'success' => true,
		            'id' => $elemento->id,
					'name' => $elemento->persona->nombre,
		            'paterno' => $elemento->persona->apellidopaterno,
					'materno' => $elemento->persona->apellidomaterno,
					'fecha'	=> $elemento->fechanacimiento,
					'matricula'	=> 	$nummatricula,
		        );
		}
    	else if(count($elemento) > 1){
    		$dato = array();
			foreach ($elemento as $elemento) {
				 $dato[] = array(
				 	'id' => $elemento->id,
				 	'nombre' => $elemento->persona->nombre,
				 	'paterno' => $elemento->persona->apellidopaterno,
				 	'materno' => $elemento->persona->apellidomaterno,
				 	'fecha' => $elemento->fechanacimiento,
				 	'matricula' => $elemento->matricula,
				 	);
			}
    	}
    	else
		$dato = array('success' => false);

		return Response::json($dato);	
	}

	public function postRegistrarpago(){
		$rules = array(
			'id' => 'required|integer|exists:elementos',
			'cantidad' => 'required|numeric'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  $dato = array('success' => false,'errormessage' => '<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		$id = Input::get('id');
		$cantidad = Input::get('cantidad');

		$pagos = Pago::where('elemento_id','=',$id)->where('fecha','like',date("Y").'%')->first();
		if(is_null($pagos)){
			
			$matricula = Elemento::find($id)->matricula;
			
			if(is_null($matricula)){
				$matricula = new Matricula;
					$matricula->elemento_id = $id;
					$matricula->matricula = '002579';
				$matricula->save();
			}
				$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = 'matricula';
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = $cantidad;
				$pago->save();

				$dato = array(
					'success' => true,
					'matricula' => '<strong>'.$matricula->matricula.'</strong>',
					'message' => 'El pago se a registrado exitosamente numero de Matricula: '
					);	
		}
		else
			$dato = array('success' => false,'errormessage' => 'El pago ya se fue registrado el <strong>'.date("d/m/Y",strtotime($pagos->fecha)).'</strong>');
		
		return Response::json($dato);
	}

	public function postRecibo(){
		$rules = array(
			'id' => 'required|integer|exists:elementos'
			);
		
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{		
		  return Redirect::back()->with('status', 'fail_create');
		}

		$id = Input::get('id');

		$elemento = Elemento::find($id);
		$hacienda = Cargo::find(1)->elementos()->where('fecha_fin','=',null)->first();

		if(!is_null($elemento)){
			$datos = array(
				'name' => $elemento->persona->nombre.' '.
						  $elemento->persona->apellidopaterno.' '.
						  $elemento->persona->apellidomaterno,
				'grado' => $elemento->grados()->orderBy('fecha','desc')->first()->nombre,
				'reclutamiento' => $elemento->reclutamiento,
				'fecha' => date('d/m/Y',strtotime($elemento->fechaingreso)),

				'hacienda' => $hacienda->persona->nombre.' '.
							  $hacienda->persona->apellidopaterno.' '.
							  $hacienda->persona->apellidomaterno,
				'gradohacienda' => $hacienda->grados()->orderBy('fecha','desc')->first()->nombre
				);
			return View::make('pagos/recibomembrecia')-> with('datos',$datos);
		}

		//$hacienda = Cargo::find(1)->elementos()->where('fecha_fin','=',null)->first();
		//echo($hacienda->persona->nombre.' '.$hacienda->persona->apellidopaterno.' '.$hacienda->persona->apellidomaterno);
		//echo($hacienda->grados()->orderBy('fecha','desc')->first()->nombre);
		////////////////////////////////////
		//$elemento = Elemento::find(1)->grados()->orderBy('fecha','desc')->first();
		//echo($elemento->elementos->first()->persona->nombre.'- '.
		//	$elemento->nombre.'- '.
		//	$elemento->elementos->first()->reclutamiento.'- '.
		//	$elemento->elementos->first()->fechaingreso);
		///////////////////////////
		else
		return View::make('pagos/recibomembrecia');
	}
}