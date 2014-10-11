<?php
class Companiasysubzona extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('nombre','tipo','estatus');
	public function elementos(){
		return $this->hasMany('Elemento');
	}
}