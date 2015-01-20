<?php
class Equipo extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('correo','telefono','escuela','estado','evento_id');
    public function elemento()
    {
        return $this->hasOne('Evento');
    }
}