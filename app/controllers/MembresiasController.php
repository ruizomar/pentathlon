<?php

class MembresiasController extends BaseController {

	public function getIndex(){
		return View::make('pagos/index');
	}

	public function postBuscar(){
		$rules = array(
			'nombre' => 'required',
			'paterno' => 'required'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{
			$dato = array('success'=>false,
				'errormessage'=>'<i class="fa fa-exclamation-triangle fa-lg"></i>Ocurrio un error');
			return Response::json($dato);
		}

		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');

		$elemento = Elemento::whereHas('persona',function($q) use ($nombre,$paterno,$materno){ 
			$q->where('nombre','like',$nombre.'%','and')
			->where('apellidopaterno','=',$paterno,'and')
			->where('apellidomaterno','like',$materno.'%');
		})->get();

		if(count($elemento) == 1){
			$elemento = $elemento->first();
			if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') {
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
					'matricula'	=> $nummatricula,
				);
			}
			else
				$dato = array('success' => false,'ms' => true);
		}
		else if(count($elemento) > 1){
			$dato = array();
			foreach ($elemento as $elemento) {
				if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') {
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
		}
		else
		$dato = array('success' => false,'ms' => false);

		return Response::json($dato);
	}

	public function postRegistrarpago(){
		$rules = array(
			'id' => 'required|integer|exists:elementos',
			'cantidad' => 'required|numeric'
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
		if (Input::get('concepto') != 'Matricula') {
			$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = Input::get('concepto') ;
					$pago->fecha = date("Y-m-d");
					$pago->cantidad = $cantidad;
				$pago->save();
				$dato = array(
					'success' => true,
					'matricula' => '',
					'message' => 'El pago se a registrado exitosamente'
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
					$matricula->matricula = '002579';
				$matricula->save();
			}
				$pago = new Pago;
					$pago->elemento_id = $id;
					$pago->concepto = 'Matricula';
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
			$dato = array('success' => false,
				'errormessage' => 'El pago ya se fue registrado el <strong>'.date("d/m/Y",strtotime($pagos->fecha)).'</strong>');

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
			return View::make('pagos/recibomembrecia')->with('datos',$datos);
		}
		else
		return View::make('pagos/recibomembrecia');
	}
}