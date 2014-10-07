<?php
class EditaReclutaController extends BaseController {

	public function editar()
	{
		return View::make('recluta.editar');
	}

	public function buscar()
	{

		$personaElemento = Persona::where('nombre','=',Input::get('reclunombre'),
							'and apellidomaterno =',Input::get('reclupaterno'),
							'and apellidopaterno =',Input::get('reclumaterno')
							)->orderBy('id', 'desc')->first();

		return Redirect::to('/lista');
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
		return View::make('registro.lista')->with('personas',$personas);
	}
}