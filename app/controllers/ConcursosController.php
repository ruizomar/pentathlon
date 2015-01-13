<?php
class ConcursosController extends BaseController {

	public function __construct()
    {
        // $this->beforeFilter('auth');
    }

	public function getIndex()
	{
		return View::make('concursos.concursos');
	}

	public function getEvento()
	{
		return View::make('concursos.concursos');
	}

}