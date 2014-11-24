<?php
class Reminder extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('user_id','token','token_live');
    public function users()
    {
        return $this->belongsTo('User');
    }
}