<?php namespace Cvp\Repos\Dealpic;

use Cvp\Repos\DbBaseRepository;

class DbDealpicRepository extends DbBaseRepository implements DealpicRepository {
	
	/**
	 * @var Dealpic
	 */

	protected $model;

	function __construct(\Dealpic $model)
	{
		$this->model = $model;
	}

	/**
	 * Find all feature pics for specified deal
	 *
	 * @param  int          $deal_id
	 * @return Model
	 */

	public function findDealFeaturePics($deal_id)
	{
		$output = \Deal::find($deal_id)->featurepics;
		
		return $output;
	}

}