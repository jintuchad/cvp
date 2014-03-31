<?php namespace Cvp\Repos\Deal;

use Cvp\Repos\DbBaseRepository;

class DbDealRepository extends DbBaseRepository implements DealRepository {
	
	/**
	 * @var Deal
	 */

	protected $model;

	function __construct(\Deal $model)
	{
		$this->model = $model;
	}

	/**
	 * Get all deals currently scheduled for the specified city (and optional dealcategory)
	 *
	 * @param  Model        $city
	 * @param  int          $dealcategory_id
	 * @return Collection
	 */
	public function getActiveForCity($city, $dealcategory_id = 0)
	{
		$now = date('Y-m-d');

		$output = $city->deals()
			->withPivot('id', 'sales_boost')
			->where('promotions.active', '=', 1)
			->where('promotions.startdate', '<=', $now)
			->where('promotions.enddate', '>=', $now);

		if ($dealcategory_id)
		{
			$output = $output->where('dealcategory_id', '=', $dealcategory_id);
		}

		return $output->get();
	}

	/**
	 * Get a deal by its 'deal_link' (in the form of : 'promotions.id-deals.slug')
	 *
	 * @param  string    $deal_link
	 * @return Model
	 */
	public function getByDealLink($deal_link)
	{
		$deal_slug = substr($deal_link, strpos($deal_link, '-')+1);

		return $this->model->where('slug', '=', $deal_slug)->first();
	}

}