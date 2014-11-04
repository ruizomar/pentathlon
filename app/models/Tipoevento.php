<?php
class Tipoevento extends Eloquent {
	public $timestamps = false;
	
    public function eventos(){
        return $this->hasMany('Evento');
    }
}