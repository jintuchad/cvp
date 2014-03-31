<?php

class Dealpic extends Eloquent {

	protected $table = 'dealpics';

	public function deals()
	{
		return $this->belongsToMany('Deal', 'dealpics_deals');
	}

}