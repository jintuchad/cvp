<?php

class Dealcategory extends Eloquent {

	protected $table = 'dealcategories';

	public function deals()
	{
		return $this->hasMany('Deal');
	}

}