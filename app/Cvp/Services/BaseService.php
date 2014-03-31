<?php namespace Cvp\Services;

class BaseService {

	protected $errors;
	protected $message;

	public function __construct()
	{
		$this->errors = null;
		$this->message = null;
	}

	public function errors()
	{
		return $this->errors;
	}

	public function message()
	{
		return $this->message;
	}

}