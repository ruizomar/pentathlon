<?php
class Cargo extends Eloquent{
	public $timestamps = false;
	public function elementos(){
		return $this->belongsToMany('Elemento')->withPivot('fecha_inicio','fecha_fin');
	}

}