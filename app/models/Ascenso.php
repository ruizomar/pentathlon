<?php
class Ascenso extends Eloquent {
	public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('Grado');
    }

    public function elemento()
    {
        return $this->belongsTo('Elemento');
    }
}