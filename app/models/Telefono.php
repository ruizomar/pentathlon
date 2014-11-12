<?php
class Telefono extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('persona_id','telefono','tipo');
    public function persona()
    {
        return $this->belongsTo('Persona');
    }
}