<?php
class Arresto extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('arrestado','fecha','motivo','matriculaarrestador','sancion');

	public function elemento(){
		return $this->belongsTo('Elemento','arrestado');
	}

}