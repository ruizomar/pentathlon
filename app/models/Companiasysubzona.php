<?php
class Companiasysubzona extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('nombre','tipo','status');
	public function elementos(){
		return $this->hasMany('Elemento');
	}
}