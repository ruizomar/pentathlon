<?php
class Cargo extends Eloquent{
	public $timestamps = false;
	public function elementos(){
		return $this->belongsToMany('Elemento')->withPivot('companiasysubzona_id','fecha_inicio','fecha_fin');
	}

}