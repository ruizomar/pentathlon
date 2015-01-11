<?php
class Donativo extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('nombre','paterno','materno','donativo','fecha');
}