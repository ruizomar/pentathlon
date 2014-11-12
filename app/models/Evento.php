<?php
class Evento extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('nombre','lugar','fecha','descripcion','precio','tipoevento_id');
	public function tipoevento(){
        return $this->belongsTo('Tipoevento');
    }
    public function elementos(){
		return $this->belongsToMany('Elemento');
	}
}