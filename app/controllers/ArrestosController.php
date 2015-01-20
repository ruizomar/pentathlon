<?php 
class ArrestosController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('militar');
    }
	public function getIndex(){
		return View::make('arrestos/arrestos');
	}

	public function postElemento(){
		$elemento 		= 	Elemento::find(Input::get('id'));
		$matricula 		= 	$elemento->matricula;
		$nummatricula	=	"";
			if (!is_null($matricula)) {
				$nummatricula 	= 	$matricula->id;
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
	public function postNuevo(){
		$rules = array(
			'id' 		=> 	'required',
			'motivo' 	=> 	'required',
			'sancion' 	=> 	'required',
			'Fecha' 	=> 	'required'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
		{
			$dato = array('success'=>false,
				'errormessage'=>'Ocurrio un error');
			return Response::json($dato);
		}
		$arrestador = Elemento::find(Auth::user()->elemento_id)->matricula->id;
		$arresto = Arresto::create(array(
			'arrestado'				=>		Input::get('id'),
			'fecha'					=>		Input::get('Fecha'),
			'motivo'				=>		Input::get('motivo'),
			'matriculaarrestador'	=>		$arrestador,
			'sancion'				=>		Input::get('sancion')
		));
		$dato = array('success'=>true,
				'errormessage'=>'Todo salio bien ',
				'asd'=>$arrestador);
			return Response::json($dato);
	}
		

}