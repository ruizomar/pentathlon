<?php
class Cargo extends Eloquent{

public function elementos(){
		return $this->belongsToMany('Elemento','cargosobtenido')->withPivot('fecha_inicio','fecha_fin');
	}

}