<?php 
class CondecoracionesController extends BaseController{

	public function getIndex(){
		return View::make('administracion/condecoraciones');
	}

}