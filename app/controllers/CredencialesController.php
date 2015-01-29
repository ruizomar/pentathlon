<?php
 
class CredencialesController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('tecnica');
    }
    public function getIndex()
    {
        return View::make('credenciales.credenciales')->with('companias',Companiasysubzona::all());
    }
    public function postElementos()
    {
        $rules = array(
            'compania' => 'required|exists:companiasysubzonas,id',
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
            if(is_integer($key)){
                $elemento = array();
                $Elemento = Elemento::find($key);
                $elemento['foto']       = $Elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta;
                $elemento['nombre']     = $Elemento->persona->nombre." ".$Elemento->persona->apellidopaterno." ".$Elemento->persona->apellidomaterno;
                $elemento['compania']   = $Elemento->companiasysubzona->tipo." ".$Elemento->companiasysubzona->nombre;
                $elemento['grado']      = $Elemento->grados->last()->nombre;
                $elemento['curp']       = $Elemento->curp;
                $elemento['calle']      = $Elemento->calle;
                $elemento['colonia']    = $Elemento->colonia;
                $elemento['municipio']  = $Elemento->municipio;
                $elemento['sangre']     = $Elemento->tiposangre;
                $elementos[]            = $elemento;
            }
        }

        $html =  View::make('credenciales/impresion')->with('elementos',$elementos); 
        $pdf = App::make('dompdf');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}

?>