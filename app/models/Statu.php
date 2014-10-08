<?php
class Statu extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('elemento_id', 'tipo', 'inicio', 'fin', 'descripcion');
	public function elemento(){
		return $this->belongsTo('Elemento');
	}

}