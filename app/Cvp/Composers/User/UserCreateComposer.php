<?php namespace Cvp\Composers\User;

class UserCreateComposer {

	public function compose($view)
	{
		$langs = getLocaleArray();

		$view->with('langs', $langs);
	}

}