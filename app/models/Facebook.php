<?php
class Facebook extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('persona_id','direccion');
    public function persona()
    {
        return $this->belongsTo('Persona');
    }
}