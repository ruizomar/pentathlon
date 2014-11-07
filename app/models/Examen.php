<?php
class Examen extends Eloquent{
	public $timestamps = false;
	public function elementos(){
		return $this->belongsToMany('Elemento')->withPivot('fecha','calificacion');
	}

}