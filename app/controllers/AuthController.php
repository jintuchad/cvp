<?php

use Cvp\Services\UserService;

class AuthController extends \BaseController {

	protected $userService;

	/**
	 * Create a new controller instance.
	 *
	 * @param UserService  $userService
	 *
	 * @return Controller
	 */
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

	/**
	 * Display the login form
	 *
	 * @return Response
	 */
	public function create()
	{
		// if user has just registered, notify them about verification email
		$just_registered = Session::get('just_registered', 0);

		$email = Session::get('email', '');

		return View::make('auth.login', compact('just_registered', 'email'));
	}

	/**
	 * Perform a login request
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->userService->login(Input::all()))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		return Redirect::intended('dashboard');
	}

	/**
	 * Perform a logout request
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$this->userService->logout();

		return Redirect::route('auth-login');
	}

	/**
	 * Display the "forgot my password" form for initiating a reminder email
	 *
	 * @return Response
	 */
	public function forgotPassword()
	{
		return View::make('auth.forgot-password');
	}

	/**
	 * Perform a password reminder
	 *
	 * @return Response
	 */
	public function postForgotPassword()
	{
		if (!$this->userService->remind(Input::all()))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::info('A password reset email has been sent to that email address.')->flash();

		return Redirect::route('auth-forgot-password');
	}

	/**
	 * Show the password reset form for the given token
	 *
	 * @param  string  $token
	 *
	 * @return Response
	 */
	public function resetPassword($token)
	{
		return View::make('auth.reset-password')->with('token', $token);
	}

	/**
	 * Perform a password reset
	 *
	 * @return Response
	 */
	public function postResetPassword()
	{
		if (!$this->userService->resetPassword(Input::all()))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('Your password has been successfully updated.')->flash();

		return Redirect::route('auth-login')->withInput();
	}

}