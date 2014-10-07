<?php
class Persona extends Eloquent{
	public $timestamps = false;
	public function elemento()
	{
	    return $this->hasOne('Elemento');
	}
}