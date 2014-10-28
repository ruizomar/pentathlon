<?php
class Reconocimiento extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('nombre','fecha','elemento_id');

	public function elemento(){
		return $this->belongsTo('Elemento');
	}

}