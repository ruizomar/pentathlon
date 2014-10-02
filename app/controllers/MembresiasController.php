<?php

class MembresiasController extends BaseController {

	public function getIndex(){

		return View::make('pagos/index');
	}

	public function buscar(){

		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');

		$persona = DB::table('personas')->where('nombre','like','%'.$nombre.'%')->where('apellidopaterno','=',$paterno)->where('apellidomaterno','like',$materno)->first();
		if(!is_null($persona)){
			$elemento = DB::table('elementos')->where('persona_id','=',$persona->id)->first();
			$matricula = DB::table('matriculas')->where('elemento_id','=',$persona->id)->first();
			
			if(!is_null($matricula))
				$nummatricula = $matricula->matricula;
			else
				$nummatricula = "";
			$dato = array(
	            'success' => true,
	            'id' => $persona->id,
				'name' => $persona->nombre,
	            'paterno' => $persona->apellidopaterno,
				'materno' => $persona->apellidomaterno,
				'fecha'	=> $elemento->fechanacimiento,
				'matricula'	=> 	$nummatricula,
	        );
	        return Response::json($dato);
		}
    		else{
				$dato = array('success' => false);
				return Response::json($dato);
			}		
	}

}