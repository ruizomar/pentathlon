<?php
class EditaReclutaController extends BaseController {

	public function editar()
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
		return View::make('recluta.editar')->with('armas',$armasArr)->with('cuerpos',$cuerposArr)->with('companiasysubzonas',$companiasysubzonasArr);
	}

	public function buscar()
	{
		$nombre = Input::get('nombre');
		$paterno = Input::get('paterno');
		$materno = Input::get('materno');
		$elemento = Elemento::whereHas('persona',function($q) use ($nombre,$paterno,$materno)
		{
			$q->where('nombre','like',$nombre.'%')
			->where('apellidopaterno','=',$paterno)
			->where('apellidomaterno','like',$materno.'%');
		})
		->get();
		if(count($elemento) == 1){
			$elemento = $elemento -> first();
			$dato = EditaReclutaController::mostrarElemento($elemento);
		}
		else if(count($elemento) > 1){
			$dato = array();
			foreach ($elemento as $elementito) {
				$dato[] = EditaReclutaController::mostrarElemento($elementito);
			}
		}
		else
		$dato = array('success' => false);

		return Response::json($dato);

	}
	public function update()
	{
		$personaElemento = Persona::find(Input::get('persona_id')) -> update(array(
			'nombre' => Input::get('reclunombre'),
			'apellidopaterno' => Input::get('reclupaterno'),
			'apellidomaterno' => Input::get('reclumaterno'),
			'sexo' => Input::get('reclusexo')
		));
		$elemento = Elemento::where('persona_id','=',Input::get('persona_id')) -> update(array(
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
			'alergias' => Input::get('alergia'),
			'adiccion' => Input::get('vicios'),
			'tipoarma_id' => Input::get('arma'),
			'tipocuerpo_id' => Input::get('cuerpo'),
			'companiasysubzona_id' => Input::get('compania'),
			'estado' => Input::get('estado'),
			'tiposangre' => Input::get('tiposangre'),

		));
		$data = array(
			'persona_id' => Input::get('persona_id'),
		);
		$facebook = Facebook::firstOrCreate($data)->update(array(
			'direccion' => Input::get('reclufacebook'),
		));
		if (Input::get('reclufacebook') == "") {
			Facebook::where('persona_id', '=', Input::get('persona_id'))->delete();
		}

		$twitter = Twitter::firstOrCreate($data)->update(array(
			'usuario' => Input::get('reclutwitter'),
		));
		if (Input::get('reclutwitter') == "") {
			Twitter::where('persona_id', '=', Input::get('persona_id'))->delete();
		}

		$email = Email::firstOrCreate($data)->update(array(
			'email' => Input::get('email'),
		));
		if (Input::get('email') == "") {
			Email::where('persona_id', '=', Input::get('persona_id'))->delete();
		}

		$data = array(
			'persona_id' => Input::get('persona_id'),
			'tipo' => 'fijo',
		);
		$fijo = Telefono::firstOrCreate($data)->update(array(
			'telefono' => Input::get('reclutelefonofijo'),
		));
		if (Input::get('reclutelefonofijo') == "") {
			Telefono::where('persona_id', '=', Input::get('persona_id'))->where('tipo','=','fijo')->delete();
		}

		$data = array(
			'persona_id' => Input::get('persona_id'),
			'tipo' => 'movil',
		);
		$fijo = Telefono::firstOrCreate($data)->update(array(
			'telefono' => Input::get('reclutelefonomovil'),
		));
		if (Input::get('reclutelefonomovil') == "") {
			Telefono::where('persona_id', '=', Input::get('persona_id'))->where('tipo','=','movil')->delete();
		}
		/////////////////////////////
		Persona::find(100) -> update(array(
			'nombre' => Input::get('contactonombre'),
			'apellidopaterno' => Input::get('contactopaterno'),
			'apellidomaterno' => Input::get('contactomaterno'),
			'sexo' => Input::get('contactosexo'),
		));
		return EditaReclutaController::editar();
	}

	public function mostrarElemento($elemento)
	{
		$matricula = "";
		$telefonofijo = "";
		$telefonomovil = "";
		$facebook = "";
		$twitter = "";
		$email = "";
		$fotoperfil ="default.png";
		$contactotelefonofijo = "";
		$contactotelefonomovil = "";
		$contactoemail = "";
		$contactofacebook = "";
		$contactotwitter = "";

		if(!is_null($elemento -> matricula))
		{
			$matricula = $elemento -> matricula -> matricula;
		}
		if(!is_null($elemento -> persona -> telefonos() -> where('tipo','=','fijo') -> first()) )
		{
			$telefonofijo = $elemento -> persona -> telefonos() -> where('tipo','=','fijo') -> first() -> telefono;
		}
		if(!is_null($elemento -> persona -> telefonos() -> where('tipo','=','movil') -> first()) )
		{
			$telefonomovil = $elemento -> persona -> telefonos() -> where('tipo','=','movil') -> first() -> telefono;
		}
		if(!is_null($elemento -> persona -> twitter) )
		{
			$twitter = $elemento -> persona -> twitter -> usuario;
		}
		if(!is_null($elemento -> persona -> facebook) )
		{
			$facebook = $elemento -> persona -> facebook -> direccion;
		}
		if(!is_null($elemento -> persona -> email) )
		{
			$email = $elemento -> persona -> email -> email;
		}
		//////////////////////////
		if(!is_null(Persona::find($elemento -> tutor -> persona_id) -> telefonos() -> where('tipo','=','movil') -> first()) )
		{
			$contactotelefonomovil = Persona::find($elemento -> tutor -> persona_id) -> telefonos() -> where('tipo','=','movil') ->first() -> telefono;
		}
		if(!is_null(Persona::find($elemento -> tutor -> persona_id) -> telefonos() -> where('tipo','=','fijo') -> first()) )
		{
			$contactotelefonofijo = Persona::find($elemento -> tutor -> persona_id) -> telefonos() -> where('tipo','=','fijo') -> first() -> telefono;
		}
		if(!is_null(Persona::find($elemento -> tutor -> persona_id) -> twitter) )
		{
			$contactotwitter = Persona::find($elemento -> tutor -> persona_id) -> twitter -> usuario;
		}
		if(!is_null(Persona::find($elemento -> tutor -> persona_id) -> facebook) )
		{
			$contactofacebook = Persona::find($elemento -> tutor -> persona_id) -> facebook -> direccion;
		}
		if(!is_null(Persona::find($elemento -> tutor -> persona_id) -> email) )
		{
			$contactoemail = Persona::find($elemento -> tutor -> persona_id) -> email -> email;
		}

		if(!is_null($elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() ) )
		{
			$fotoperfil = $elemento -> documentos() -> where('tipo','=','fotoperfil') -> first() -> ruta;
		}

		$dato = array(
			'success' => true,
			'id' => $elemento -> id,
			'persona_id' => $elemento -> persona -> id,
			'name' => $elemento -> persona -> nombre,
			'paterno' => $elemento -> persona -> apellidopaterno,
			'materno' => $elemento -> persona -> apellidomaterno,
			'sexo' => $elemento -> persona -> sexo,
			'matricula'	=> $matricula,
			'estatura' => $elemento -> estatura,
			'peso' => $elemento -> peso,
			'ocupacion' => $elemento -> ocupacion,
			'estadocivil' => $elemento -> estadocivil,
			'fechanacimiento' => $elemento -> fechanacimiento,
			'escolaridad' => $elemento -> escolaridad,
			'escuela' => $elemento -> escuela,
			'fechaingreso' => $elemento -> fechaingreso,
			'lugarnacimiento' => $elemento -> lugarnacimiento,
			'curp' => $elemento -> curp,
			'calle' => $elemento -> calle,
			'colonia' => $elemento -> colonia,
			'cp' => $elemento -> cp,
			'municipio' => $elemento -> municipio,
			'estado' => $elemento -> estado,
			'reclutamiento' => $elemento -> reclutamiento,
			'email' => $email,
			'alergias' => $elemento -> alergias,
			'adiccion' => $elemento -> adiccion,
			'arma' => $elemento -> tipoarma_id,
			'cuerpo' => $elemento -> tipocuerpo_id,
			'compania' => $elemento -> companiasysubzona_id,
			'reclutelefonomovil' => $telefonomovil,
			'reclutelefonofijo' => $telefonofijo,
			'facebook' => $facebook,
			'twitter' => $twitter,
			'tiposangre' => $elemento -> tiposangre,
			'fotoperfil' => $fotoperfil,
			'contactonombre' => Persona::find($elemento -> tutor -> persona_id) -> nombre,
			'contactopaterno' => Persona::find($elemento -> tutor -> persona_id) -> apellidopaterno,
			'contactomaterno' => Persona::find($elemento -> tutor -> persona_id) -> apellidomaterno,
			'contactosexo' => Persona::find($elemento -> tutor -> persona_id) -> sexo,
			'contactorelacion' => $elemento -> tutor -> relacion,
			'contactotelefonofijo' => $contactotelefonofijo,
			'contactotelefonomovil' => $contactotelefonomovil,
			'contactoemail' => $contactoemail,
			'contactofacebook' => $contactofacebook,
			'contactotwitter' => $contactotwitter,
		);
		return $dato;
	}
}