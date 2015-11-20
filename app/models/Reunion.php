<?php
class Reunion extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('zona','grado','nombre','reunion','cargo','seccion');
}