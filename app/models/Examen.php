<?php
class Examen extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('nombre','grado_id','precio');
	public function elementos(){
		return $this->belongsToMany('Elemento')->withPivot('fecha','calificacion');
	}
	public function grado(){
		return $this->belongsTo('Grado');
	}
}