<?php
class Tipoarma extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('nombre');
	public function elementos(){
		return $this->hasMany('Elemento');
	}
}