<?php
class Twitter extends Eloquent {
	public $timestamps = false;
    public function persona()
    {
        return $this->belongsTo('Persona');
    }
}