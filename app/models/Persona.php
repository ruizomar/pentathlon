<?php
class Persona extends Eloquent{

	public function elemento()
	{
	    return $this->hasOne('Elemento');
	}
	
}