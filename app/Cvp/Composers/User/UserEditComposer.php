<?php namespace Cvp\Composers\User;

class UserEditComposer {

	public function compose($view)
	{
		$langs = getLocaleArray();

		$view->with('langs', $langs);
	}

}