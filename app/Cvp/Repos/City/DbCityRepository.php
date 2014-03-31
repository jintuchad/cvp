<?php namespace Cvp\Repos\City;

use Cvp\Repos\DbBaseRepository;

class DbCityRepository extends DbBaseRepository implements CityRepository {
	
	/**
	 * @var City
	 */

	protected $model;

	function __construct(\City $model)
	{
		$this->model = $model;
	}

	/**
	 * Gets cities available for user selection/browsing
	 *
	 * @return Model
	 */
	public function getSelectionList()
	{
		return $this->model->active()->orderBy('name', 'asc')->get();
	}

	/**
	 * Get an active city by its id
	 *
	 * @param  int  $id
	 * @return Model
	 */
	public function findActive($id)
	{
		$output = $this->model->active()->findOrFail($id);

		return $output;
	}

	/**
	 * Get an active city by its slug
	 *
	 * @param  string  $slug
	 * @return Model
	 */
	public function findActiveBySlug($slug)
	{
		$output = $this->model->active()->where('slug', '=', $slug)->firstOrFail();

		return $output;
	}

}