<?php

class Deal extends Eloquent {

	protected $table = 'deals';

	public function dealcategory()
	{
		return $this->belongsTo('Dealcategory');
	}

	public function cities()
    {
        return $this->belongsToMany('City', 'promotions');
    }

    public function dealoptions()
	{
		return $this->hasMany('Dealoption')->orderBy('order');
	}

    public function dealpics()
	{
		return $this->belongsToMany('Dealpic', 'dealpics_deals');
	}

	public function dealtabs()
	{
		return $this->hasMany('Dealtab')->orderBy('order');
	}

	public function listThumbnail()
	{
		return $this->dealpics()->where('dealpics_deals.is_listthumb','=',1)->first();
	}

	public function featurepics()
	{
		return $this->dealpics()->where('dealpics_deals.is_feature','=','1')->orderBy('dealpics_deals.order_feature');
	}

	public function getStickerPriceAttribute()
	{
		$output = 0;

		foreach ($this->dealoptions as $do)
		{
			$output = ($do->price > $output) ? $do->price : $output;
		}

		return $output;
	}

	public function getStickerValueAttribute()
	{
		$output = 0;

		foreach ($this->dealoptions as $do)
		{
			$output = ($do->value > $output) ? $do->value : $output;
		}

		return $output;
	}

	public function getFinePrintContentAttribute()
	{
		// purchase limit text
		
		# max_purchase
		$purchaseLimitText = ($this->max_purchase) ? 'Limit: '.$this->max_purchase.' purchase per person, ' : 'No purchase limit, ';

		# max_gift
		$purchaseLimitText .= ($this->max_purchase) ? (($this->max_gift > 1) ? 'may buy '.$this->max_gift.' as gifts.' : 'may buy 1 as gift.') : 'may buy unlimited as gifts.';

		// fine print text

		$finePrintText = ($this->fine_print) ? '<h4>Fine Print</h4>'.$this->fine_print : '';
		
		// redemption instructions

		// $redemptionInstructionsText = ($this->instructions) ? '<h4 style="margin-top:30px;">Redemption Instructions</h4>'.$this->instructions : '';
		$redemptionInstructionsText = '';
		
		return $finePrintText.'<p>'.$purchaseLimitText.'</p>'.$redemptionInstructionsText;
	}

	public function getTotalSalesAttribute()
	{
		$output = 0;

		foreach ($this->dealoptions as $do)
		{
			$output += $do->total_sales;
		}

		return $output;
	}

}