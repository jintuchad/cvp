<?php

use Cvp\Repos\User\UserRepository;
use Cvp\Services\UserService;
use Cvp\Mailers\UserMailer;

class UserController extends \BaseController {

	protected $userRepo;
	protected $userService;
	/**
	 * Create a new controller instance.
	 *
	 * @param UserRepository  $userRepo
	 * @param UserService     $userService
	 *
	 * @return Controller
	 */
	public function __construct(UserRepository $userRepo, UserService $userService)
	{
		$this->userRepo = $userRepo;
		$this->userService = $userService;

		$this->beforeFilter('permission:view_user', array('only' => array('index', 'show')));
		$this->beforeFilter('permission:create_user', array('only' => array('create')));
		$this->beforeFilter('permission:edit_user', array('only' => array('edit')));
	}

	/**
	 * Display the user management list
	 *
	 * @return Response
	 */
	public function index()
	{
		// $users = $this->userRepo->getPaginatedWhere(3, 'disabled', 1);

		$users = $this->userRepo->getUserIndex(Input::all());

		return View::make('user.index')->with('users', $users);
	}
	
	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$available_roles = $this->userService->getAvailableRolesForSelect(Auth::user()->getLevel());

		return View::make('user.create', compact('available_roles'));
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->userService->create(Input::all()))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('User successfully created!')->flash();

		return Redirect::route('dashboard.users.index');
	}

	/**
	 * Show user
	 *
	 * @param  int  $crypt_id
	 * @return Response
	 */
	public function show($crypt_id)
	{
		$user = $this->userRepo->get(Crypt::decrypt($crypt_id));

		return View::make('user.edit', compact('user'));
	}

	/**
	 * Show the form for editing a user
	 *
	 * @param  int  $crypt_id
	 * @return Response
	 */
	public function edit($crypt_id)
	{
		$user = $this->userRepo->get(Crypt::decrypt($crypt_id));

		$available_roles = $this->userService->getAvailableRolesForSelect(Auth::user()->getLevel());

		return View::make('user.edit', compact('user', 'available_roles'))->withEditForm(1);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $crypt_id
	 * @return Response
	 */
	public function update($crypt_id)
	{
		$user_id = Crypt::decrypt($crypt_id);

		if (!$this->userService->update($user_id, Input::all()))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('User successfully updated!')->flash();

		return Redirect::route('dashboard.users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $crypt_id
	 * @return Response
	 */
	public function destroy($crypt_id)
	{
		$user_id = Crypt::decrypt($crypt_id);

		if (!$this->userService->delete($user_id))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('User successfully deleted!')->flash();

		return Redirect::route('dashboard.users.index');
	}

	/**
	 * Disable the specified user
	 *
	 * @param  int  $crypt_id
	 * @return Response
	 */
	public function disable($crypt_id)
	{
		$user_id = Crypt::decrypt($crypt_id);

		if (!$this->userService->disable($user_id))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('User successfully disabled!')->flash();

		return Redirect::route('dashboard.users.index');
	}

	/**
	 * Display the user profile form
	 *
	 * @return Response
	 */
	public function profile()
	{
		$user = $this->userRepo->get(Auth::user()->id);

		return View::make('user.profile', compact('user'))->withShowTab(Input::get('tab'));
	}

	/**
	 * Perform a self-change password request
	 *
	 * @return Response
	 */
	public function selfChangePassword()
	{
		if (!$this->userService->changePassword(Input::all()))
		{
			return Redirect::route('user-profile', array('tab' => 'account'))->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('Your password has been successfully changed.')->flash();

		return Redirect::route('user-profile', array('tab' => 'account'));
	}

	/**
	 * Perform a language update request
	 *
	 * @return Response
	 */
	public function selfUpdateLocalization()
	{
		if (!$this->userService->updateLocale(Auth::user()->id, Input::all()))
		{
			return Redirect::route('user-profile', array('tab' => 'localization'))->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('Your language settings have been successfully updated.')->flash();

		return Redirect::route('user-profile', array('tab' => 'localization'));
	}

	/**
	 * Display the user verification form
	 *
	 *  @param  string  $crypt_user_id
	 * 
	 *  @return Response
	 */
	public function verify($crypt_user_id)
	{
		$user = $this->userRepo->get(Crypt::decrypt($crypt_user_id));

		return View::make('user.verify', compact('user', 'crypt_user_id'));
	}

	/**
	 * Perform a login request
	 *
	 * @return Response
	 */
	public function postVerify()
	{
		if (!$this->userService->verify(Input::all()))
		{
			if ($this->userService->message())
			{
				Alert::error($this->userService->message())->flash();
			}

			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Session::flash('email', Input::get('email'));

		Alert::success('Your account has been verified!')->flash();
		return Redirect::route('auth-login');
	}

	/**
	 * Show manual registration form
	 *
	 * @return Response
	 */
	public function register()
	{
		return View::make('user.register');
	}

	/**
	 * Store a newly registered user in storage.
	 *
	 * @return Response
	 */
	public function postRegister()
	{
		$user = $this->userService->create(Input::all());

		if (!$user)
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('You have successfully registered yourself!')->flash();

		// set flag for login page
		Session::flash('just_registered', '1');

		return Redirect::route('auth-login');
	}

	/**
	 * Send verification reminder email from admin
	 *
	 * @param  string  $crypt_id
	 * @return Response
	 */
	public function verificationRemind($crypt_id)
	{
		$user_id = Crypt::decrypt($crypt_id);

		if (!$this->userService->verificationRemind($user_id))
		{
			return Redirect::back()->withErrors($this->userService->errors())->withInput();
		}

		Alert::success('User verification email sent.')->flash();

		return Redirect::route('dashboard.users.edit', $crypt_id);
	}

}