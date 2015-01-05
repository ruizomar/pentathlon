<?php
class Grado extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('nombre','imagen');
	public function elementos(){
		return $this->belongsToMany('Elemento','ascensos')->withPivot('fecha');
	}

	public function examenes(){
		return $this->hasMany('Examen');
	}
}