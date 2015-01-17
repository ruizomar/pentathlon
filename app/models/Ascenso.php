<?php
class Ascenso extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('id','grado_id','elemento_id','fecha');
}