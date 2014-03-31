<?php

class Dealtab extends Eloquent {

	protected $table = 'dealtabs';

	public function deal()
	{
		return $this->belongsTo('Deal');
	}

}