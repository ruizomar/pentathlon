<?php
class Grado extends Eloquent{
	public $timestamps = false;
	public function elementos(){
		return $this->belongsToMany('Elemento','ascensos')->withPivot('fecha');
	}

}