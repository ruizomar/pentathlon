<?php 
class BuscarController extends BaseController{

	public function buscar(){
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
				$dato = array(
					'success' => true,
					'id' => $elemento->id
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

}