<?php namespace Cvp\Repos\Orderdealoption;

use Cvp\Repos\DbBaseRepository;

class DbOrderdealoptionRepository extends DbBaseRepository implements OrderdealoptionRepository {
	
	/**
	 * @var Orderdealoption
	 */

	protected $model;

	function __construct(\Orderdealoption $model)
	{
		$this->model = $model;
	}

	//

}