<?php

use Cvp\Repos\City\CityRepository;
use Cvp\Repos\Deal\DealRepository;
use Cvp\Repos\Dealcategory\DealcategoryRepository;

class CityController extends \BaseController {

	protected $cityRepo;
	protected $dealRepo;
	protected $dealcategoryRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @param CityRepository  $cityRepo
	 * @param DealRepository  $dealRepo
	 * @param DealcategoryRepository  $dealcategoryRepo
	 *
	 * @return Controller
	 */
	public function __construct(CityRepository $cityRepo, DealRepository $dealRepo, DealcategoryRepository $dealcategoryRepo)
	{
		$this->cityRepo = $cityRepo;
		$this->dealRepo = $dealRepo;
		$this->dealcategoryRepo = $dealcategoryRepo;
	}

	/**
	 * Display the city selection page
	 *
	 * @return Response
	 */
	public function index()
	{
		$cities = $this->cityRepo->getSelectionList();

		return View::make('city.select', compact('cities'));
	}

	/**
	 * Show currently scheduled deals for specified city (optional: filter by dealcategory)
	 *
	 * @param  string  $city_slug
	 * @param  string  $dealcategory_slug
	 * 
	 * @return Response
	 */
	public function promotions($city_slug, $dealcategory_slug = null)
	{
		$city = $this->cityRepo->findActiveBySlug($city_slug);

		if (!$city)
		{
			return Redirect::route('city-index');
		}

		Event::fire('city.select', $city);

		$dealcategory = null;
		$dealcategory_id = 0;

		if ($dealcategory_slug)
		{
			$dealcategory = $this->dealcategoryRepo->findBySlug($dealcategory_slug);
			$dealcategory_id = $dealcategory->id;
		}

		$deals = $this->dealRepo->getActiveForCity($city, $dealcategory_id);

		return View::make('city.promotions', compact('dealcategory', 'deals'));
	}

}