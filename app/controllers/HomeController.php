<?php

use Cvp\Repos\City\CityRepository;

class HomeController extends \BaseController {

	protected $cityRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @param CityRepository  $cityRepo
	 *
	 * @return Controller
	 */
	public function __construct(CityRepository $cityRepo)
	{
		$this->cityRepo = $cityRepo;
	}

	/**
	 * Display the default page based on user input
	 *
	 * @return Response
	 */
	public function index()
	{
		// if city has been selected this session, direct to that city promotion list
		
		$active_city = Session::get('user_active_city');

		if ($active_city)
		{
			// get city only if it is still active
			$city = $this->cityRepo->findActive($active_city->id);

			if ($city)
			{
				// direct to city
				return Redirect::to($city->slug);
			}
		}

		// else, if user is logged in and has a default city, direct them to that city promotion list
		
		$default_city = Session::get('user_default_city');

		if ($default_city)
		{
			// get city only if it is still active
			$city = $this->cityRepo->findActive($default_city->id);

			if ($city)
			{
				// direct to city
				return Redirect::to($city->slug);
			}
		}

		// direct to city index page
		return Redirect::route('city-index');
	}

}