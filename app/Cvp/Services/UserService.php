<?php namespace Cvp\Services;

use Cvp\Services\BaseService;

use Cvp\Repos\User\UserRepository;
use Cvp\Validators\UserValidator;
use Cvp\Repos\Role\RoleRepository;
use Cvp\Mailers\UserMailer;

use Chadmazilly\Smee\UserNotFoundException;
use Chadmazilly\Smee\UserUnverifiedException;
use Chadmazilly\Smee\UserDisabledException;
use Chadmazilly\Smee\UserDeletedException;
use Chadmazilly\Smee\UserPasswordIncorrectException;

use Auth;
use Password;
use Alert;
use Event;
use Session;
use Crypt;

class UserService extends BaseService {

	protected $userRepo;
	protected $roleRepo;
	protected $userMailer;

	/**
	 * Create a new service instance.
	 *
	 * @param UserRepository  $userRepo
	 * @param RoleRepository  $roleRepo
	 * @param UserMailer      $userMailer
	 *
	 * @return Service
	 */
	public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, UserMailer $userMailer)
	{
		parent::__construct();

		$this->userRepo = $userRepo;
		$this->roleRepo = $roleRepo;
		$this->userMailer = $userMailer;
	}

	/**
	 * Creates a new user
	 *
	 * @param  array  $input[]
	 * @return bool
	 */
	public function create(array $input)
	{
		// validation
		
		$validation = new UserValidator;

		if (isset($input['generate_password']))
		{
			if (!$validation->passesCreateNoPassword())
			{
				$this->errors = $validation->getErrors();

				return false;
			}
		}
		else
		{
			if (!$validation->passesCreate())
			{
				$this->errors = $validation->getErrors();

				return false;
			}
		}

		// create user
		
		$data = array(
			'email' => $input['email'],
			'username' => $input['email'],
			'password' => (isset($input['generate_password'])) ? str_random(8) : $input['password'],
			'verified' => (isset($input['verify'])) ? 1 : 0,
		);

		$user = $this->userRepo->create($data);

		// assign role to user
		
		if ($input['role'])
		{
			$user->roles()->sync(array($input['role']));
		}

		Event::fire('user.create', $input['email']);

		return $user;
	}

	/**
	 * Updates a user
	 *
	 * @param  int    $user_id
	 * @param  array  $input
	 * @return bool
	 */
	public function update($user_id, array $input)
	{
		// if disabling user
		if (isset($input['disable']))
		{
			$user = $this->userRepo->update($user_id, array(
				'disabled' => 1
			));

			return $user;
		}

		// if enabling user
		if (isset($input['enable']))
		{
			$user = $this->userRepo->update($user_id, array(
				'disabled' => 0
			));

			return $user;
		}

		// validation
		$validation = new UserValidator;

		if (!$validation->passesUpdate())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		$data = array(
			'locale' => $input['locale']
		);

		if ($input['password'])
		{
			$data['password'] = $input['password'];
		}

		$user = $this->userRepo->update($user_id, $data);

		if ($input['role'])
		{
			$user->roles()->sync(array($input['role']));
		}
		elseif($user->roles()->count())
		{
			$user->roles()->detach();
		}

		// Session::put('user.locale', $input['locale']);

		return true;
	}

	/**
	 * Deletes a user
	 *
	 * @param  int    $user_id
	 * @return User
	 */
	public function delete($user_id)
	{
		$user = $this->userRepo->delete($user_id);

		return $user;
	}
	
	/**
	 * Attempt to log in a user
	 *
	 * @param  array  $input[email, password, remember]
	 * @return bool
	 */
	public function login(array $input)
	{
		// validation
		$validation = new UserValidator;

		if (!$validation->passesLogin())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		try
		{
			// attempt to log in
			Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), (isset($input['remember'])) ? true : false);

			Event::fire('user.login', Auth::user());

			return true;
		}

		catch (UserNotFoundException $exception)
		{
			Alert::error('That user could not be found.')->flash();

			return false;
		}

		catch (UserUnverifiedException $exception)
		{
			// TODO: provide link for verification
			Alert::error('Sorry, your account has not yet been verified.')->flash();

			return false;
		}

		catch (UserDisabledException $exception)
		{
			Alert::error('That user has been disabled.')->flash();
			
			return false;
		}

		catch (UserDeletedException $exception)
		{
			Alert::error('That user does not exist.')->flash();

			return false;
		}

		catch (UserPasswordIncorrectException $exception)
		{
			Alert::error('That password is invalid, please try again.')->flash();
			
			return false;
		}
	}

	/**
	 * Logout a user
	 *
	 * @return bool
	 */
	public function logout()
	{
		$user = Auth::user();

		Auth::logout();

		Event::fire('user.logout', $user);

		return true;
	}

	/**
	 * Send the specified email a password reset link
	 *
	 * @param  array  $input[email]
	 * @return bool
	 */
	public function remind(array $input)
	{
		// validation
		$validation = new UserValidator;

		if (!$validation->passesRemind())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		$credentials = array('email' => $input['email']);

		try
		{
			// send a password reset link by email
			return Password::remind($credentials, function($message, $user)
			{
				$message->subject('Your Password Reminder');
			});
		}

		catch (UserNotFoundException $exception)
		{
			Alert::error('That user could not be found.')->flash();

			return false;
		}

		catch (UserUnverifiedException $exception)
		{
			// TODO: provide link for verification
			Alert::error('That user is unverified.')->flash();

			return false;
		}

		catch (UserDisabledException $exception)
		{
			Alert::error('That user has been disabled.')->flash();
			
			return false;
		}

		catch (UserDeletedException $exception)
		{
			Alert::error('That user has been removed.')->flash();

			return false;
		}

		catch (UserPasswordIncorrectException $exception)
		{
			Alert::error('That password is invalid, please try again.')->flash();
			
			return false;
		}

	}

	/**
	 * Attempts to update user password for specific email with valid token
	 *
	 * @param  array  $input[email, password, password_confirmation]
	 * @return bool
	 */
	public function resetPassword(array $input)
	{
		// validation
		$validation = new UserValidator;

		if (!$validation->passesResetPassword())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		$credentials = array(
			'token' => $input['token'],
			'email' => $input['email'],
			'password' => $input['password'],
			'password_confirmation' => $input['password_confirmation']
		);

		try
		{
			// attempt to reset user password
			return Password::reset($credentials, function($user, $password)
			{
				// update the user password
				$user->password = $password;
				$user->save();

				return true;
			});
		}

		catch (UserNotFoundException $exception)
		{
			Alert::error('That user could not be found.')->flash();

			return false;
		}

		catch (UserUnverifiedException $exception)
		{
			// TODO: provide link for verification
			Alert::error('That user is unverified.')->flash();

			return false;
		}

		catch (UserDisabledException $exception)
		{
			Alert::error('That user has been disabled.')->flash();
			
			return false;
		}

		catch (UserDeletedException $exception)
		{
			Alert::error('That user has been removed.')->flash();

			return false;
		}

		catch (UserPasswordIncorrectException $exception)
		{
			Alert::error('That password is invalid, please try again.')->flash();
			
			return false;
		}

	}

	/**
	 * Attempts to change an authenticated user's password at their request
	 *
	 * @param  array  $input[old_password, password, password_confirmation]
	 * @return bool
	 */
	public function changePassword(array $input)
	{
		// validation
		$validation = new UserValidator;

		if (!$validation->passesChangePassword())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		$credentials = array(
			'email' => $input['email'],
			'password' => $input['old_password']
		);

		try
		{
			if (!Auth::validate($credentials))
			{
			    Alert::error('That password did not match your current password.')->flash();

				return false;
			}

			$user_id = Auth::user()->id;

			$this->userRepo->update($user_id, array('password' => $input['password']));

			return true;
		}

		catch (UserNotFoundException $exception)
		{
			Alert::error('That user could not be found.')->flash();

			return false;
		}

		catch (UserUnverifiedException $exception)
		{
			// TODO: provide link for verification
			Alert::error('That user is unverified.')->flash();

			return false;
		}

		catch (UserDisabledException $exception)
		{
			Alert::error('That user has been disabled.')->flash();
			
			return false;
		}

		catch (UserDeletedException $exception)
		{
			Alert::error('That user has been removed.')->flash();

			return false;
		}

		catch (UserPasswordIncorrectException $exception)
		{
			Alert::error('That password is invalid, please try again.')->flash();
			
			return false;
		}
	}

	/**
	 * Updates a user's last login timestamp
	 *
	 * @param  int  $user_id
	 * @return bool
	 */
	public function updateLastLogin($user_id = null)
	{
		$this->userRepo->update($user_id, array(
			'last_login' => date('Y-m-d H:i:s')
		));

		return true;
	}

	/**
	 * Attempts to update an authenticated user's language settings at their request
	 *
	 * @param  int    $user_id
	 * @param  array  $input[locale]
	 * @return bool
	 */
	public function updateLocale($user_id, array $input)
	{
		$this->userRepo->update($user_id, array(
			'locale' => $input['locale']
		));

		Session::put('user.locale', $input['locale']);

		return true;
	}

	/**
	 * Attempt to verify a user
	 *
	 * @param  array  $input[email, password]
	 * @return bool
	 */
	public function verify(array $input)
	{
		// validation

		$validation = new UserValidator;

		if (!$validation->passesVerify())
		{
			$this->errors = $validation->getErrors();

			return false;
		}

		// verify user against stored email

		$user = $this->userRepo->get(Crypt::decrypt($input['crypt_user_id']));
		$user_to_match = $this->userRepo->getWhere('email', $input['email'])->first();

		if ($user->id != $user_to_match->id)
		{
			$this->message = 'Sorry, we could not validate your account. Please contact the administrator.';

			return false;
		}

		// update verified status

		$this->userRepo->update($user->id, array('verified' => 1));

		// send verification email

		$this->userMailer->verified($user);

		return true;
	}

	/**
	 * Retrieves all roles available for assignment by the specified user
	 *
	 * @param  int  $level
	 * @return Role
	 */
	public function getAvailableRolesForSelect($level = 0)
	{
		$output = array();

		$roles = $this->roleRepo->allForAssignment($level);

		if (!$roles)
		{
			return $output;
		}

		$output['0'] = '';

		foreach($roles as $role)
		{
			$output[$role->id] = $role->name;
		}

		return $output;
	}

	/**
	 * Sends a verification email to user
	 *
	 * @param  int  $user_id
	 * @return bool
	 */
	public function verificationRemind($user_id)
	{
		$user = $this->userRepo->get($user_id);

		if ($user->verified)
		{
			$this->message = 'That user has already been verified!';

			return false;
		}

		// send verification email

		$this->userMailer->verify($user);

		return true;
	}

}