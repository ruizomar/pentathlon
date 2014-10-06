<?php
class Companiasysubzona extends Eloquent{
	public $timestamps = false;
	public function elementos(){
		return $this->hasMany('Elemento');
	}
}