<?php
class Tutor extends Eloquent {
    protected $table = 'tutores';
    protected $fillable = array('persona_id','elemento_id','relacion');
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('Persona');
    }

    public function elemento()
    {
        return $this->belongsTo('Elemento');
    }
}