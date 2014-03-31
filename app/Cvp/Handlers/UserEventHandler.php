<?php namespace Cvp\Handlers;

use Cvp\Repos\City\CityRepository;
use Cvp\Services\UserService;
use Cvp\Mailers\UserMailer;

use Session;

class UserEventHandler {

	protected $cityRepo;
	protected $userService;
	protected $userMailer;

	/**
	 * Create a new handler instance.
	 *
	 * @param CityRepository  $cityRepo 
	 * @param UserService     $userService
	 * @param UserMailer      $userMailer
	 *
	 * @return Handler
	 */
	public function __construct(UserService $userService, UserMailer $userMailer, CityRepository $cityRepo)
	{
		$this->cityRepo = $cityRepo;
		$this->userService = $userService;
		$this->userMailer = $userMailer;
	}

	/**
	 * User login events
	 *
	 * @param  object  $user
	 * @return void
	 */
	public function onLogin($user)
	{
		// update user's last login timestamp
		$this->userService->updateLastLogin($user->id);

		// set locale to user's preference
		Session::put('user.locale', $user->locale);

		// attempt to set a default city in session
		if ($user->default_city_id)
		{
			// if city still active
			$default_city = $this->cityRepo->findActive($user->default_city_id);

			if ($default_city)
			{
				Session::put('user_default_city', $default_city);
			}
		}
	}

	/**
	 * User logout events
	 *
	 * @param  object  $user
	 * @return void
	 */
	public function onLogout($user)
	{
		// forget locale
		Session::forget('user.locale');

		Session::forget('user_default_city');
	}

	/**
	 * User login events
	 *
	 * @param  object  $user
	 * @return void
	 */
	public function onCreate($data)
	{
		if (!$user->verified)
		{
			$this->userMailer->verify($user);
		}
	}

	public function subscribe($events)
	{
		$events->listen('user.login', 'Cvp\Handlers\UserEventHandler@onLogin');
		$events->listen('user.logout', 'Cvp\Handlers\UserEventHandler@onLogout');
		$events->listen('user.create', 'Cvp\Handlers\UserEventHandler@onCreate');
	}

}