<?php

class MembresiasController extends BaseController {

	public function getIndex(){
		return View::make('pagos/pagos')
			->with('eventos',Evento::where('fecha','>=',date('Y-m-d'))
			->orderBy('fecha','asc')
			->get());
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
			'foto'		=> $elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta
			);
			return Response::json($dato);
	}

	public function postRegistrarpago(){
		$rules = array(
			'id' => 'required|integer|exists:elementos',
			'cantidad' => 'numeric'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation -> fails())
		{
			$dato = array('success' => false,
				'errormessage' => '<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		$id = Input::get('id');
		$cantidad = Input::get('cantidad');
		////////////////////////////
		if (Input::get('concepto') == 'Credencial') {
			$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = Input::get('concepto') ;
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = $cantidad;
				$pago->save();
				$dato = array(
					'success' 	=> true,
					'matricula' => '',
					'message' 	=> 'El pago se a registrado exitosamente',
					'pago' 		=> $pago->id
					);
		return Response::json($dato);
		}
		if (is_numeric(Input::get('concepto'))) {
			if(!is_null(Evento::find(Input::get('concepto'))->elementos->first())){
				$dato = array(
					'success' 	=> false,
					'errormessage' 	=> 'El pago ya se registro anteriormente',
					);
				return Response::json($dato);
			}
			$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = Evento::find(Input::get('concepto'))->nombre;
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = Evento::find(Input::get('concepto'))->costo;
				$pago->save();

		$elemento = Elemento::find($id);
		$elemento->eventos()->attach(Input::get('concepto'));

				$dato = array(
					'success' 	=> true,
					'matricula' => '',
					'message' 	=> 'El pago se a registrado exitosamente',
					'pago' 		=> $pago->id
					);
		return Response::json($dato);
		}
		////////////////////////////
		$pagos = Pago::where('elemento_id','=',$id,'and')
				->where('fecha','like',date("Y").'%','and')
				->where('concepto','=','Matricula')->first();

		if(is_null($pagos)){
			$matricula = Elemento::find($id)->matricula;
			if(is_null($matricula)){
				$matricula = new Matricula;
					$matricula->elemento_id = $id;
				$matricula->save();
			}
				$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = 'Matricula';
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = $cantidad;
				$pago->save();
				$dato = array(
					'success' 	=> true,
					'matricula' => '<strong>'.$matricula->id.'</strong>',
					'message' 	=> 'El pago se a registrado exitosamente numero de Matricula: ',
					'pago' 		=> $pago->id
					);
		}
		else
			$dato = array('success' => false,
				'errormessage' 		=> 'El pago ya se fue registrado el <strong>'.date("d/m/Y",strtotime($pagos->fecha)).'</strong>',
				'pago' 				=> $pagos->id
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
		$hacienda = Cargo::find(1)->elementos()->where('fecha_fin','=',null)->first();

		if(!is_null($pago)){
			$datos = array(
				'name' 			=>  $pago->elemento->persona->nombre.' '.
							 		$pago->elemento->persona->apellidopaterno.' '.
							  		$pago->elemento->persona->apellidomaterno,
				'grado' 		=>  $pago->elemento->grados()->orderBy('fecha','desc')->first()->nombre,
				'reclutamiento' =>  $pago->elemento->reclutamiento,
				'fecha' 		=>  date('d/m/Y'),
				'zona' 			=> 	$pago->elemento->companiasysubzona->nombre,
				'hacienda' 		=>  $hacienda->persona->nombre.' '.
									$hacienda->persona->apellidopaterno.' '.
									$hacienda->persona->apellidomaterno,
				'gradohacienda' => 	$hacienda->grados()->orderBy('fecha','desc')->first()->nombre,
				'folio'			=>	$pago->id,
				'concepto'		=>  $pago->concepto
				);
			return View::make('pagos/recibomembrecia')->with('datos',$datos);
		}
		else
		return View::make('pagos/recibomembrecia');
	}
}