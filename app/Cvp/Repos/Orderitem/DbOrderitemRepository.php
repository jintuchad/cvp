<?php namespace Cvp\Repos\Orderitem;

use Cvp\Repos\DbBaseRepository;

class DbOrderitemRepository extends DbBaseRepository implements OrderitemRepository {
	
	/**
	 * @var Orderitem
	 */

	protected $model;

	function __construct(\Orderitem $model)
	{
		$this->model = $model;
	}

	//

}