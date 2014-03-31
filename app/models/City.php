<?php

class City extends Eloquent {

	protected $table = 'cities';

	public function deals()
	{
		return $this->belongsToMany('Deal', 'promotions');
	}

	public function scopeActive($query)
	{
		return $query->where('active', '=', 1);
	}

}