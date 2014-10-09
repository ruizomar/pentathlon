<?php
class EditaReclutaController extends BaseController {

	public function editar()
	{
		return View::make('recluta.editar');
	}

	public function buscar()
	{
		$nombre = Input::get('reclunombre');
		$paterno = Input::get('reclupaterno');
		$materno = Input::get('reclumaterno');

		$elemento = Elemento::whereHas('persona',function($q) use ($nombre,$paterno,$materno)
			{
				$q->where('nombre','like',$nombre.'%')
				->where('apellidopaterno','=',$paterno)
				->where('apellidomaterno','like',$materno.'%');
			})
			->get();
		//echo $elemento;
		if(count($elemento) == 1){
			$elemento = $elemento -> first();
			$matricula = $elemento -> matricula;
				$nummatricula = "";
				if(!is_null($matricula))
					$nummatricula = $matricula -> matricula;
				$dato = array(
					'success' => true,
					'id' => $elemento -> id,
					'name' => $elemento -> persona -> nombre,
					'paterno' => $elemento -> persona -> apellidopaterno,
					'materno' => $elemento -> persona -> apellidomaterno,
					'fecha'	=> $elemento -> fechanacimiento,
					'matricula'	=> $nummatricula,
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
					'email' => $elemento -> email,
					'alergias' => $elemento -> alergias,
					'adiccion' => $elemento -> adiccion,
					'tipoarma_id' => $elemento -> tipoarma_id,
					'tipocuerpo_id' => $elemento -> tipocuerpo_id,
					'companiasysubzona_id' => $elemento -> companiasysubzona_id,
				);
		}
		else if(count($elemento) > 1){
			$dato = array();
			foreach ($elemento as $elemento) {
				$dato[] = array(
					'id' => $elemento -> id,
					'nombre' => $elemento -> persona -> nombre,
					'paterno' => $elemento -> persona -> apellidopaterno,
					'materno' => $elemento -> persona -> apellidomaterno,
					'fecha' => $elemento -> fechanacimiento,
					'matricula' => $elemento -> matricula,
					);
			}
		}
		else
		$dato = array('success' => false);
//asñkdnvnlnvlernvpwrnvpnwrvnkvnwñvnqpihvpowhvwoehvohevhwrovhwprhbworhbhwrpobh
		return Response::json($dato);

	}
}