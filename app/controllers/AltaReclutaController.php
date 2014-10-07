<?php
class AltaReclutaController extends BaseController {

	public function get_nuevo()
	{
		return View::make('recluta.alta');
	}

	public function post_nuevo()
	{
		//Elemento
		AltaReclutaController::agregarPersona(Input::get('reclunombre'),
											Input::get('reclupaterno'),
											Input::get('reclumaterno'),
											Input::get('reclusexo')
											);
		$personaElemento = Persona::where('nombre','=',Input::get('reclunombre'),
							'and apellidomaterno =',Input::get('reclupaterno'),
							'and apellidopaterno =',Input::get('reclumaterno')
							)->orderBy('id', 'desc')->first();
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

		$elemento = new Elemento;
		$elemento -> persona_id = $personaElemento->id;
		$elemento -> estatura = Input::get('estatura');
		$elemento -> peso = Input::get('peso');
		$elemento -> ocupacion = Input::get('ocupacion');
		$elemento -> estadocivil = Input::get('estadocivil');
		$elemento -> fechanacimiento = Input::get('birthday');
		$elemento -> escolaridad = Input::get('escolaridad');
		$elemento -> escuela = Input::get('escuela');
		$elemento -> fechaingreso = date('Y-m-d');
		$elemento -> lugarnacimiento = Input::get('lugnac');
		$elemento -> curp = Input::get('curp');
		$elemento -> calle = Input::get('domicilio');
		$elemento -> colonia = Input::get('colonia');
		$elemento -> cp = Input::get('postal');
		$elemento -> municipio = Input::get('municipio');
		$elemento -> estado = Input::get('estado');
		$elemento -> reclutamiento = 33;
		$elemento -> email = Input::get('email');
		$elemento -> alergias = Input::get('alergia');
		$elemento -> adiccion = Input::get('vicios');
		$elemento -> tipoarma_id = Input::get('arma');
		$elemento -> tipocuerpo_id = Input::get('cuerpo');
		$elemento -> companiasysubzona_id = Input::get('compania');
		$elemento -> save();

		//Tutor
		AltaReclutaController::agregarPersona(Input::get('contactonombre'),
											Input::get('contactopaterno'),
											Input::get('contactomaterno'),
											Input::get('contactosexo')
											);
		$personaTutor = Persona::where('nombre','=',Input::get('contactonombre'),
							'and apellidomaterno =',Input::get('contactopaterno'),
							'and apellidopaterno =',Input::get('contactomaterno')
							)->orderBy('id', 'desc')->first();

		if (Input::get('contactotelefonofijo') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonofijo'));
		}
		if (Input::get('contactotelefonomovil') != "") {
			AltaReclutaController::agregarTelefono($personaTutor->id,Input::get('contactotelefonomovil'));
		}
		if (Input::get('contactotwitter') != "") {
			AltaReclutaController::agregarFacebook($personaTutor->id,Input::get('contactotwitter'));
		}
		if (Input::get('contactofacebook') != "") {
			AltaReclutaController::agregarTwitter($personaTutor->id,Input::get('contactofacebook'));
		}

		$elemento_id = Elemento::where('persona_id','=',$personaElemento->id
							)->orderBy('id', 'desc')->first();

		AltaReclutaController::agregarTutor($personaTutor->id,$elemento_id->id,Input::get('contactorelacion'));

		return Redirect::to('recluta/lista');
	}

	public function agregarTelefono($id,$tel)
	{
		$telefono = new Telefono;
		$telefono -> persona_id = $id;
		$telefono -> telefono = $tel;
		$telefono -> save();
	}

	public function agregarPersona($nombre,$paterno,$materno,$sexo)
	{
		$persona = new Persona;
		$persona -> nombre = $nombre;
		$persona -> apellidopaterno = $paterno;
		$persona -> apellidomaterno =$materno;
		$persona -> sexo = $sexo;
		$persona -> save();
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

	public function lista()
	{
		$personas = Persona::all();
		return View::make('recluta.lista')->with('personas',$personas);
	}
}