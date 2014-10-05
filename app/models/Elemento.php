<?php
class Elemento extends Eloquent{
	
	public function persona(){
		return $this->belongsTo('Persona');
	}
	public function matricula(){
		return $this->hasOne('Matricula');
	}
	public function pagos(){
		return $this->hasMany('Pago');
	}
	public function grados(){
		return $this->belongsToMany('Grado','ascensos')->withPivot('fecha');
	}
	public function cargos(){
		return $this->belongsToMany('Cargo','cargosobtenido')->withPivot('fecha_inicio','fecha_fin');
	}
}