<?php
class Asistencia extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('companiasysubzona_id','fecha','tipo','elemento_id');

	public function elemento(){
		return $this->belongsTo('Elemento');
	}
	public function companiasysubzona(){
		return $this->belongsTo('Companiasysubzona');
	}
}