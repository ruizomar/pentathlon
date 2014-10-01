<?php

class MembresiasController extends BaseController {

	public function getIndex(){

		return View::make('pagos/index');
	}

	public function buscar(){

		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');

		$matricula = Input::get('matricula');

		if($matricula != "" && $matricula != "0"){
			$elemento = DB::table('elementos')->where('matricula','=',$matricula)->first();
			if(!is_null($elemento)){
				$persona = Persona::find($elemento->id);
		        $data = array(
		            'success' => true,
		            'id' => $persona->id,
					'name' => $persona->nombre,
		            'paterno' => $persona->apellidopaterno,
					'materno' => $persona->apellidomaterno,
					'fecha'	=> $elemento->fechanacimiento,
					'matricula'	=> 	$elemento->matricula,
		        );
		        return Response::json($data);
	    	}
	    	else{
				$data = array('success' => false);
				return Response::json($data);
			}
    	}
    	else{
    		$persona = DB::table('personas')->where('nombre','like','%'.$nombre.'%')->where('apellidopaterno','=',$paterno)->where('apellidomaterno','like',$materno)->first();
    		if(!is_null($persona)){
    			$elemento = DB::table('elementos')->where('persona_id','=',$persona->id)->first();
    			$dato = array(
		            'success' => true,
		            'id' => $persona->id,
					'name' => $persona->nombre,
		            'paterno' => $persona->apellidopaterno,
					'materno' => $persona->apellidomaterno,
					'fecha'	=> $elemento->fechanacimiento,
					'matricula'	=> 	$elemento->matricula,
		        );
		        return Response::json($dato);
    		}
    		else{
				$dato = array('success' => false);
				return Response::json($dato);
			}	
    	}
    	
		
	}

}