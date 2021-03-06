<?php
class Equipo extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('correo','telefono','escuela','estado','evento_id','nivel');
    public function elemento()
    {
        return $this->hasOne('Evento');
    }
    public function concursantes()
    {
        return $this->hasMany('Concursante');
    }
}