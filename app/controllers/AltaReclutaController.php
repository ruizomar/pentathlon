<?php
class AltaReclutaController extends BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter(function(){
		    if(is_null(User::find(Auth::id())->roles()->where('nombre','=','archivo')->first()) && is_null(User::find(Auth::id())->roles()->where('nombre','=','comandante de compañia')->first()))
    	 		return "No Tienes acceso";
        });
    }

	public function get_nuevo()
	{
		$armas = Tipoarma::all();
		$armasArr = array();
		foreach($armas as $arma)
		{
			$armasArr[$arma->id] = $arma->nombre;
		}

		$cuerpos = Tipocuerpo::all();
		$cuerposArr = array();
		foreach($cuerpos as $cuerpo)
		{
			$cuerposArr[$cuerpo->id] = $cuerpo->nombre;
		}

		$companiasysubzonas = Companiasysubzona::where('status','=','activa')->get();
		$companiasysubzonasArr = array();
		foreach($companiasysubzonas as $compayzona)
		{
			$companiasysubzonasArr[$compayzona->id] = $compayzona->nombre;
		}

		return View::make('recluta.alta')->with('armas',$armasArr)->with('cuerpos',$cuerposArr)->with('companiasysubzonas',$companiasysubzonasArr);
	}

	public function errorCurp()
	{
		$curp = $_POST['curp'];
		if(Elemento::where('curp','=',$curp)->count()){
			$dato = array('success' => false,
				);
		}
		else{
			$dato = array('success' => true,
				);
		}
		return ($dato);
	}

	public function post_nuevo()
	{
		////// 25/01/2017  validar curp //////
		$rules = array(
			'curp' => 'required|unique:elementos',
			);
		$mesages = array(
						'curp.required' => 'La CURP es requerida!',
						'curp.unique' => 'La CURP ya esta registrada!'
						);

		$validation = Validator::make(Input::all(), $rules, $mesages);
		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->errors());
			//return redirect()->back()->withInput(Request::all())->withErrors($v->errors());
		}
	    ///////////////////////////////////////////////////Elemento
		$personaElemento = Persona::create(array(
			'nombre' => Input::get('reclunombre'),
			'apellidopaterno' => Input::get('reclupaterno'),
			'apellidomaterno' => Input::get('reclumaterno'),
			'sexo' => Input::get('reclusexo')
		));
		$reclutamiento = 40 + ((date('Y') - 2013) * 2);
		if(date('m') > 6)
			$reclutamiento++;
		$elemento = Elemento::create(array(
			'persona_id' => $personaElemento->id,
			'estatura' => Input::get('estatura'),
			'peso' => Input::get('peso'),
			'ocupacion' => Input::get('ocupacion'),
			'estadocivil' => Input::get('estadocivil'),
			'fechanacimiento' => Input::get('birthday'),
			'escolaridad' => Input::get('escolaridad'),
			'escuela' => Input::get('escuela'),
			'fechaingreso' => date('Y-m-d'),
			'lugarnacimiento' => Input::get('lugnac'),
			'curp' => Input::get('curp'),
			'calle' => Input::get('domicilio'),
			'colonia' => Input::get('colonia'),
			'cp' => Input::get('postal'),
			'municipio' => Input::get('municipio'),
			'estado' => Input::get('estado'),
			'reclutamiento' => $reclutamiento,
			'alergias' => Input::get('alergia'),
			'adiccion' => Input::get('vicios'),
			'tipoarma_id' => Input::get('arma'),
			'tipocuerpo_id' => Input::get('cuerpo'),
			'companiasysubzona_id' => Input::get('compania'),
			'tiposangre' => Input::get('tiposangre'),
			'estado' => Input::get('estado'),
		));
		if (Input::get('reclutelefonofijo') != "") {
			AltaReclutaController::agregarTelefono($personaElemento->id,Input::get('reclutelefonofijo'),'fijo');
		}
		if (Input::get('reclutelefonomovil') != "") {
			AltaReclutaController::agregarTelefono($personaElemento->id,Input::get('reclutelefonomovil'),'movil');
		}
		if (Input::get('reclufacebook') != "") {
			AltaReclutaController::agregarFacebook($personaElemento->id,Input::get('reclufacebook'));
		}
		if (Input::get('reclutwitter') != "") {
			AltaReclutaController::agregarTwitter($personaElemento->id,Input::get('reclutwitter'));
		}
		if (Input::get('recluemail') != "") {
			AltaReclutaController::agregarEmail($personaElemento->id,Input::get('recluemail'));
		}
		AltaReclutaController::registrarAscenso($elemento->id);

		if (Input::file("fotoperfil") != "") {
			$file = Input::file("fotoperfil")->move("imgs/fotos/",$elemento->id.'.'.Input::file('fotoperfil')->guessClientExtension());
			$documento = new Documento;
			$documento -> elemento_id = $elemento->id;
			$documento -> ruta = 'imgs/fotos/'.$elemento->id.'.'.Input::file('fotoperfil')->guessClientExtension();
			$documento -> tipo = 'fotoperfil';
			$documento -> save();

			AltaReclutaController::resizeImagen('', $documento->ruta, 200, 200,$documento->ruta,Input::file('fotoperfil')->guessClientExtension());
		}
		else{
			$documento = new Documento;
			$documento -> elemento_id = $elemento->id;
			$documento -> ruta = 'imgs/fotos/default.png';
			$documento -> tipo = 'fotoperfil';
			$documento -> save();
		}

	    ///////////////////////////////////////////////////Tutor
		$personaTutor = Persona::create(array(
			'nombre' => Input::get('contactonombre'),
			'apellidopaterno' => Input::get('contactopaterno'),
			'apellidomaterno' => Input::get('contactomaterno'),
			'sexo' => Input::get('contactosexo')
		));
		if (Input::get('contactotelefonofijo') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonofijo'),'fijo');
		}
		if (Input::get('contactotelefonomovil') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonomovil'),'movil');
		}
		if (Input::get('contactofacebook') != "") {
			AltaReclutaController::agregarFacebook($personaTutor->id,Input::get('contactofacebook'));
		}
		if (Input::get('contactotwitter') != "") {
			AltaReclutaController::agregarTwitter($personaTutor->id,Input::get('contactotwitter'));
		}
		if (Input::get('contactoemail') != "") {
			AltaReclutaController::agregarEmail($personaTutor->id,Input::get('contactoemail'));
		}
	    ///////////////////////////////////////////////////Relacion elemento-tutor
		AltaReclutaController::agregarTutor($personaTutor->id,$elemento->id,Input::get('contactorelacion'));

		$persona = Persona::find($personaElemento -> id);
		$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		return View::make('recluta.lista')->with('persona',$persona)->with('fotoperfil',$fotoperfil)->with('elemento',$elemento);

	}
	public function agregarTelefono($id,$tel,$tipo)
	{
		$telefono = new Telefono;
		$telefono -> persona_id = $id;
		$telefono -> telefono = $tel;
		$telefono -> tipo = $tipo;
		$telefono -> save();
	}

	public function agregarTwitter($persona_id,$usuario)
	{
		$twitter = new Twitter;
		$twitter -> persona_id = $persona_id;
		$twitter -> usuario = $usuario;
		$twitter -> save();
	}

	public function agregarFacebook($persona_id,$direccion)
	{
		$facebook = new Facebook;
		$facebook -> persona_id = $persona_id;
		$facebook -> direccion = $direccion;
		$facebook -> save();
	}

	public function agregarTutor($persona_id,$elemento_id,$relacion)
	{
		$tutor = new Tutor;
		$tutor -> persona_id = $persona_id;
		$tutor -> elemento_id = $elemento_id;
		$tutor -> relacion = $relacion;
		$tutor -> save();
	}
	public function registrarAscenso($id)
	{
		$elemento = Elemento::find($id);
		$elemento->grados()->attach(1, array('fecha' => date('Y-m-d')));
		$status = $elemento->status()->save(new Statu(array(
					'tipo' => 'Nuevo',
					'inicio' => date("Y-m-d"),
					'descripcion' => 'Nuevo elemento')));
	}

	public function agregarEmail($persona_id,$correo)
	{
		$email = new Email;
		$email -> persona_id = $persona_id;
		$email -> email = $correo;
		$email -> save();
	}
	public function resizeImagen($ruta, $nombre, $alto, $ancho,$nombreN,$extension){
        $rutaImagenOriginal = $ruta.$nombre;
        if($extension == 'GIF' || $extension == 'gif'){
        $img_original = imagecreatefromgif($rutaImagenOriginal);
        }
        if($extension == 'jpg' || $extension == 'JPG'){
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
        }
        if($extension == 'png' || $extension == 'PNG'){
        $img_original = imagecreatefrompng($rutaImagenOriginal);
        }
        if($extension == 'jpeg' || $extension == 'JPEG'){
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
        }
        $max_ancho = $ancho;
        $max_alto = $alto;
        list($ancho,$alto)=getimagesize($rutaImagenOriginal);
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;
        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
        $ancho_final = $ancho;
            $alto_final = $alto;
        } elseif (($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        } else{
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }
        $tmp=imagecreatetruecolor($ancho_final,$alto_final);
        imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
        imagedestroy($img_original);
        $calidad=70;
        imagejpeg($tmp,$ruta.$nombreN,$calidad);
        
    }
}