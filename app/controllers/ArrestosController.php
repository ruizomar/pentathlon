<?php 
class ArrestosController extends BaseController{
	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('id','<',8)->first()))
    	 		return Redirect::to('inicio');
        }, array('except' =>array('getIndex')));
    }
	public function getIndex(){
		return View::make('arrestos/arrestos');
	}

	public function getReportes()
	{
		return View::make('arrestos.reportes');
	}

	public function postReportes(){
		$inicio = new DateTime($_POST['i']);
		$fin = new DateTime($_POST['f']);
		$data = array();
		$pagos = Arresto::where('fecha','>=',$inicio) -> where('fecha','<=',$fin) -> get();
		foreach ($pagos as $pago) {
			$data[] = array(
				'nombre' => $pago -> elemento -> persona -> nombre,
				'paterno' => $pago -> elemento -> persona -> apellidopaterno,
				'materno' => $pago -> elemento -> persona -> apellidomaterno,
				'fecha' => $pago -> fecha,
				'zona' => $pago -> elemento -> companiasysubzona -> nombre,
				'grado' => $pago -> elemento -> grados -> last() -> nombre,
				'motivo' => $pago -> motivo,
				'detalles' => $pago -> sancion,
				'punisher' => $pago -> matriculaarrestador,
				);
		}
		return Response::json($data);
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