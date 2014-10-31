<?php
class Evento extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('nombre','lugar','fecha','descripcion','costo','tipoevento_id');
	public function eventos()
    {
        return $this->belongsTo('Tipoevento');
    }
}