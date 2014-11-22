<?php
class Persona extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('nombre','apellidopaterno','apellidomaterno','sexo');
    public function elemento()
    {
        return $this->hasOne('Elemento');
    }
    public function telefonos()
    {
        return $this->hasMany('Telefono');
    }
    public function email()
    {
        return $this->hasOne('Email');
    }
}