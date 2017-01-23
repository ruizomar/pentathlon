<?php
class Reunion extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('zona','grado','arma','nombre','reunion','cargo','seccion');
}