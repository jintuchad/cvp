<?php namespace Cvp\Repos\Dealoption;

use Cvp\Repos\DbBaseRepository;

class DbDealoptionRepository extends DbBaseRepository implements DealoptionRepository {
	
	/**
	 * @var Dealoption
	 */

	protected $model;

	function __construct(\Dealoption $model)
	{
		$this->model = $model;
	}

	/**
	 * Find all dealoptions for specified deal
	 *
	 * @param  int          $deal_id
	 * @return Model
	 */

	public function findDealOptions($deal_id)
	{
		$output = \Deal::find($deal_id)->dealoptions;
		
		return $output;
	}

}