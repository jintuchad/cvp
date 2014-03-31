<?php namespace Cvp\Validators;

class UserValidator extends BaseValidator {

	/**
	* Validation rules
	*/
	public static $rules = array(

		'login' => array(

			'email' => 'required|email',
			'password' => 'required',

		),

		'verify' => array(

			'email' => 'required|email',

		),

		'remind' => array(

			'email' => 'required|email',

		),

		'reset_password' => array(

			'email' => 'required|email',
			'password' => 'required|min:6|confirmed',

		),

		'change_password' => array(

			'old_password' => 'required',
			'password' => 'required|min:6|confirmed',

		),

		'create' => array(

			'email' => 'required|email|unique:users',
			'password' => 'required|min:6|confirmed',
			'locale' => 'required'

		),

		'create_no_password' => array(

			'email' => 'required|email|unique:users',
			'locale' => 'required'

		),

		'update' => array(

			'password' => 'min:6|confirmed'

		),

		// 'validate_password' => array(

		// 	'password' => 'required|min:6|confirmed',

		// ),

	);

	/**
	* Validation messages
	*/
	public static $messages = array(

		'email.unique' => 'Sorry, that email address has already been used.'

	);

	public function passesLogin()
	{
		static::$rules = static::$rules['login'];

		return $this->passes();
	}

	public function passesVerify()
	{
		static::$rules = static::$rules['verify'];

		return $this->passes();
	}

	public function passesRemind()
	{
		static::$rules = static::$rules['remind'];

		return $this->passes();
	}

	public function passesResetPassword()
	{
		static::$rules = static::$rules['reset_password'];

		return $this->passes();
	}

	public function passesChangePassword()
	{
		static::$rules = static::$rules['change_password'];

		return $this->passes();
	}

	public function passesCreate()
	{
		static::$rules = static::$rules['create'];

		return $this->passes();
	}

	public function passesCreateNoPassword()
	{
		static::$rules = static::$rules['create_no_password'];

		return $this->passes();
	}

	public function passesUpdate()
	{
		static::$rules = static::$rules['update'];

		return $this->passes();
	}
	
	// public function passesRegister()
	// {
	// 	static::$rules = static::$rules['register'];

	// 	return $this->passes();
	// }

	// public function passesCreate($validate_password = true)
	// {
	// 	if ($validate_password)
	// 	{
	// 		static::$rules = $this->mergeRules(static::$rules['create'], static::$rules['validate_password']);
	// 	}
	// 	else
	// 	{
	// 		static::$rules = static::$rules['create'];
	// 	}

	// 	return $this->passes();
	// }

	// public function passesUpdate($validate_password = true)
	// {
	// 	if ($validate_password)
	// 	{
	// 		static::$rules = $this->mergeRules(static::$rules['update'], static::$rules['validate_password']);
	// 	}
	// 	else
	// 	{
	// 		static::$rules = static::$rules['update'];
	// 	}

	// 	return $this->passes();
	// }
}