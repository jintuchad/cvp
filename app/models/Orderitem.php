<?php

class Orderitem extends Eloquent {

	protected $table = 'orderitems';

	public function dealoptions()
	{
		return $this->belongsToMany('Dealoption', 'dealoptions_orderitems');
	}

}