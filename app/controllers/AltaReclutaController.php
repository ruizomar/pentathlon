<?php
class AltaReclutaController extends BaseController {

	public function get_nuevo()
	{
		return View::make('recluta.alta');
	}

	public function post_nuevo()
	{
	///////////////////////////////////////////////////Elemento
		$personaElemento = Persona::create(array(
			'nombre' => Input::get('reclunombre'),
			'apellidopaterno' => Input::get('reclupaterno'),
			'apellidomaterno' => Input::get('reclumaterno'),
			'sexo' => Input::get('reclusexo')
		));
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
			'reclutamiento' => 33,
			'email' => Input::get('email'),
			'alergias' => Input::get('alergia'),
			'adiccion' => Input::get('vicios'),
			'tipoarma_id' =>Input::get('arma'),
			'tipocuerpo_id' =>Input::get('cuerpo'),
			'companiasysubzona_id' =>Input::get('compania')
		));
		if (Input::get('reclutelefonofijo') != "") {
			AltaReclutaController::agregarTelefono($personaElemento->id,Input::get('reclutelefonofijo'));
		}
		if (Input::get('reclutelefonomovil') != "") {
			AltaReclutaController::agregarTelefono($personaElemento->id,Input::get('reclutelefonomovil'));
		}
		if (Input::get('reclufacebook') != "") {
			AltaReclutaController::agregarFacebook($personaElemento->id,Input::get('reclufacebook'));
		}
		if (Input::get('reclutwitter') != "") {
			AltaReclutaController::agregarTwitter($personaElemento->id,Input::get('reclutwitter'));
		}
		AltaReclutaController::registrarAscenso($elemento->id);
	///////////////////////////////////////////////////Tutor
		$personaTutor = Persona::create(array(
			'nombre' => Input::get('contactonombre'),
			'apellidopaterno' => Input::get('contactopaterno'),
			'apellidomaterno' => Input::get('contactomaterno'),
			'sexo' => Input::get('contactosexo')
		));
		if (Input::get('contactotelefonofijo') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonofijo'));
		}
		if (Input::get('contactotelefonomovil') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonomovil'));
		}
		if (Input::get('contactofacebook') != "") {
			AltaReclutaController::agregarFacebook($personaTutor->id,Input::get('contactofacebook'));
		}
		if (Input::get('contactotwitter') != "") {
			AltaReclutaController::agregarTwitter($personaTutor->id,Input::get('contactotwitter'));
		}
	///////////////////////////////////////////////////Relacion elemento-tutor
		AltaReclutaController::agregarTutor($personaTutor->id,$elemento->id,Input::get('contactorelacion'));
		return Redirect::to('recluta/lista');
	}
	public function agregarTelefono($id,$tel)
	{
		$telefono = new Telefono;
		$telefono -> persona_id = $id;
		$telefono -> telefono = Input::get('reclutelefonofijo');
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
					'tipo' => 'Activo',
					'inicio' => date("Y-m-d"),
					'descripcion' => 'Nuevo elemento')));
	}

	public function lista()
	{
		$personas = Persona::all();
		return View::make('recluta.lista')->with('personas',$personas);
	}
}