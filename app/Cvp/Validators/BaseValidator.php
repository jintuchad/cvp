<?php namespace Cvp\Validators;

use Validator as V;

abstract class BaseValidator {

	protected $input;

	protected $errors;

	public function __construct($input = NULL)
	{
		$this->input = $input ?: \Input::all();
	}

	public function passes()
	{
		$validation = V::make($this->input, static::$rules, static::$messages);

		if($validation->passes()) return true;

		$this->errors = $validation->messages();

		return false;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	// TODO: fix this!
	public function mergeRules($rules1, $rules2 = array(), $rules3 = array(), $rules4 = array())
	{
		$merged = array_merge_recursive($rules1, $rules2, $rules3, $rules4);

		foreach($merged as $field => $rules)
		{
			if(is_array($rules))
			{
				$output[$field] = implode("|", $rules);
			}
			else
			{
				$output[$field] = $rules;
			}
		}
		
		return $output;
	}

}