<?php
class Role extends Eloquent {
	public $timestamps = false;
    public function user()
    {
        return $this->hasOne('User');
    }
}