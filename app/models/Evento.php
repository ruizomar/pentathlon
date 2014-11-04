<?php
class Evento extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('nombre','lugar','fecha','descripcion','costo','tipoevento_id');
	public function tipoevento(){
        return $this->belongsTo('Tipoevento');
    }
    public function elementos(){
		return $this->belongsToMany('Elemento');
	}
}