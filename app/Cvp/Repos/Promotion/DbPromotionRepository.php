<?php namespace Cvp\Repos\Promotion;

use Cvp\Repos\DbBaseRepository;

class DbPromotionRepository extends DbBaseRepository implements PromotionRepository {
	
	/**
	 * @var Promotion
	 */

	protected $model;

	function __construct(\Promotion $model)
	{
		$this->model = $model;
	}

	/**
	 * Get a promotion by its 'deal_link' (in the form of : 'promotions.id-deals.slug')
	 *
	 * @param  string    $deal_link
	 * @return Model
	 */
	public function getByDealLink($deal_link)
	{
		$promotion_id = intval(substr($deal_link, 0, strpos($deal_link, '-')));

		return $this->model->findOrFail($promotion_id);
	}

}