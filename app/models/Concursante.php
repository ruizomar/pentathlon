<?php
class Concursante extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('evento_id','nombre','paterno','materno','telefono','email','escuela','estado','tipo');
    public function elemento()
    {
        return $this->hasOne('Evento');
    }
}