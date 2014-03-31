<?php namespace Cvp\Repos\Dealcategory;

use Cvp\Repos\DbBaseRepository;

class DbDealcategoryRepository extends DbBaseRepository implements DealcategoryRepository {
	
	/**
	 * @var Dealcategory
	 */

	protected $model;

	function __construct(\Dealcategory $model)
	{
		$this->model = $model;
	}

	/**
	 * Get a dealcategory by its slug
	 *
	 * @param  string  $slug
	 * @return Model
	 */
	public function findBySlug($slug)
	{
		$output = $this->model->where('slug', '=', $slug)->firstOrFail();

		return $output;
	}

}