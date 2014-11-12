<?php
class Documento extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('elemento_id','ruta','tipo');
    public function persona()
    {
        return $this->belongsTo('Elemento');
    }
}