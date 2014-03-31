<?php namespace Cvp\Repos\Dealtab;

use Cvp\Repos\DbBaseRepository;

class DbDealtabRepository extends DbBaseRepository implements DealtabRepository {
	
	/**
	 * @var Dealtab
	 */

	protected $model;

	function __construct(\Dealtab $model)
	{
		$this->model = $model;
	}

	/**
	 * Find all feature tabs for specified deal
	 *
	 * @param  int          $deal_id
	 * @return Model
	 */

	public function findDealTabs($deal_id)
	{
		$output = \Deal::find($deal_id)->dealtabs;
		
		return $output;
	}

}