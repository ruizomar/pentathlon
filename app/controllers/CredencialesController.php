<?php
 
class CredencialesController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        //$this->beforeFilter('militar');
    }
    public function getIndex()
    {
        return View::make('credenciales.credenciales')->with('companias',Companiasysubzona::all());
    }
    public function postElementos()
    {
        $rules = array(
            'compania' => 'required|exists:Companiasysubzonas,id',
            );

        $validation = Validator::make(Input::all(), $rules);
        if($validation -> fails()){
            return Response::json(array('message' => 'Ocurrio un error intente de nuevo'));
        }
        $compania = Input::get('compania');
        $elementos = Elemento::whereHas('status',function($q) use ($compania){
                    $q->where('tipo','=','Activo');
                    })->where('companiasysubzona_id','=',$compania)->get();
        if(count($elementos) < 1)
            return Response::json(array('menssage' => 'Esta compañia no tiene elementos'));
        $Elementos = array();
        foreach ($elementos as $elemento) {
            $numatricula = 'Sin asignar';
            if(!is_null($elemento->matricula))
                $numatricula = $elemento->matricula->id;
            $Elementos[] = array($elemento->id,$numatricula,$elemento->persona->nombre." ".$elemento->persona->apellidopaterno." ".$elemento->persona->apellidomaterno,$elemento->grados->last()->nombre);
        }
        return Response::json(array('success' => true,"elementos" => $Elementos));
    }
    public function postImprimir(){
        $elementos = array();
        foreach (Input::all() as $key => $value) {
            if(is_integer($key))
                $elementos[] = Elemento::find($key);
        }
        //return View::make('credenciales.imprecion')->with('elementos',$elementos);
        $html =  View::make('credenciales.imprecion')->with('elementos',$elementos); 

        $pdf = App::make('dompdf');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}

?>