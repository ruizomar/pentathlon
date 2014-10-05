<?php
class Pago extends Eloquent{
	public $timestamps = false;

	public function elemento(){
		return $this->belongsTo('Elemento');
	}
}