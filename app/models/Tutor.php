<?php
class Tutor extends Eloquent {
	protected $table = 'tutores';
	public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('Persona');
    }

    public function elemento()
    {
        return $this->belongsTo('Elemento');
    }
}