<?php
class EditaReclutaController extends BaseController {

	public function editar()
	{
		return View::make('recluta.editar');
	}

	public function buscar()
	{
		/*
		$personaElemento = Persona::where('nombre','=',Input::get('reclunombre'),
							'and apellidomaterno =',Input::get('reclupaterno'),
							'and apellidopaterno =',Input::get('reclumaterno')
							)->first();
		$num = $personaElemento->id;
		$phone = Elemento::find(16)->id;
		$elemento_id = Elemento::where('persona_id','=',$personaElemento->id
							)->orderBy('id', 'desc')->first();
		//echo($personaElemento);
		$user      = Persona::find($num);
		$company   = $user->elemento->id;
		echo($company);
		*/
	}
	public function prueba()
	{
		$persona = Persona::create(array(
			'nombre' => 'david',
			'apellidopaterno' => 'ramirez',
			'apellidomaterno' => 'velasquez',
			'sexo' => 'H',
		));

		$elemento = Elemento::create(array(
			'persona_id' => $persona->id,
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
			'tipoarma_id' =>1,
			'tipocuerpo_id' =>1,
			'companiasysubzona_id' =>1
		));

	}
	public function otro()
	{
			$personaElemento = Persona::where('nombre','=','david','and')
			->where('apellidopaterno','=','ramirez','and')
			->where('apellidomaterno','=','velasquez')
			->orderBy('id', 'desc')->first();
			echo ($personaElemento);
	}
}