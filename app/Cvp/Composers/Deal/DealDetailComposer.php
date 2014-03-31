<?php namespace Cvp\Composers\Deal;

use Cvp\Repos\City\CityRepository;
use Cvp\Repos\Dealcategory\DealcategoryRepository;

use Auth;
use Session;

class DealDetailComposer {

	protected $cityRepo;
	protected $dealcategoryRepo;

	/**
	 * Create a new composer instance.
	 *
	 * @param CityRepository  $cityRepo
	 * @param DealcategoryRepository  $dealcategoryRepo
	 *
	 * @return Composer
	 */
	public function __construct(CityRepository $cityRepo, DealcategoryRepository $dealcategoryRepo)
	{
		$this->cityRepo = $cityRepo;
		$this->dealcategoryRepo = $dealcategoryRepo;
	}

	public function compose($view)
	{
		$active_city = Session::get('user_active_city');

		$view->with('city', $active_city);

		$dealcategories = $this->dealcategoryRepo->all();

		$view->with('dealcategories', $dealcategories);

		$cities = $this->cityRepo->getSelectionList();

		$view->with('cities', $cities);
	}

}