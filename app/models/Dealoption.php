<?php

class Dealoption extends Eloquent {

	protected $table = 'dealoptions';

	public function deal()
	{
		return $this->belongsTo('Deal');
	}

	public function orderitems()
	{
		return $this->belongsToMany('Orderitem', 'dealoptions_orderitems');
	}

	public function orderdealoptions()
	{
		return $this->hasMany('Orderdealoption');
	}

	public function getPriceAttribute()
	{
		return $this->orderitems()->sum('unit_price');
	}

	public function getValueAttribute()
	{
		return $this->orderitems()->sum('retail_value');
	}

	public function getTotalSalesAttribute()
	{
		return $this->orderdealoptions()->count();
	}

	// public function freightCharge()
	// {
	// 	return $this->orderitems()->sum('default_freight_charge');
	// }

	public function getReqShippingAttribute()
	{
		return (bool) ($this->orderitems()->sum('req_shipping'));
	}

	public function getDefaultNameAttribute()
	{
		return ($this->name) ? $this->name : $this->deal->name;
	}

	// public function getHeading()
	// {
	// 	return $this->deal->heading;
	// }

	// public function getThumbnail()
	// {
	// 	return $this->deal->dealpics()->where('dealpics_deals.is_listthumb','=',1)->first()->filename;
	// }

}