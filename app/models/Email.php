<?php
class Email extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('persona_id','email');
    public function persona()
    {
        return $this->belongsTo('Persona');
    }
}