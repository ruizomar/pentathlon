<?php
class Twitter extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('persona_id','usuario');
    public function persona()
    {
        return $this->belongsTo('Persona');
    }
}