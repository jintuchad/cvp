<?php

class Orderdealoption extends Eloquent {

	protected $table = 'orderdealoptions';

	public function dealoption()
	{
		return $this->belongsTo('Dealoption');
	}

	public function orderitems()
	{
		return $this->belongsToMany('Orderitem', 'orderdealoptions_orderitems')->withPivot('unit_price', 'req_shipping', 'freight_charge');
	}

}