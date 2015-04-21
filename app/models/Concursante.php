<?php
class Concursante extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('nombre','paterno','materno','tipo','equipo_id');
    public function elemento()
    {
        return $this->hasOne('Equipo');
    }
}