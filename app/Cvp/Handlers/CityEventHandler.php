<?php namespace Cvp\Handlers;

use Cvp\Repos\City\CityRepository;

use Session;

class CityEventHandler {

	protected $cityRepo;

	/**
	 * Create a new handler instance.
	 *
	 * @param CityRepository  $cityRepo
	 *
	 * @return Handler
	 */
	public function __construct(CityRepository $cityRepo)
	{
		$this->cityRepo = $cityRepo;
	}

	/**
	 * User login events
	 *
	 * @param  object  $user
	 * @return void
	 */
	public function onSelect($city)
	{
		// get current active city (if any)
		$active_city = Session::get('user_active_city');

		if ($active_city)
		{
			// if viewing a new city, flash the bg
			if ($city->id != $active_city->id)
			{
				Session::put('active_city_flash', 1);
			}
		}

		Session::put('user_active_city', $city);
	}

	public function subscribe($events)
	{
		$events->listen('city.select', 'Cvp\Handlers\CityEventHandler@onSelect');
	}

}