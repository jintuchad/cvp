<?php namespace Cvp\Composers\User;

use Auth;
use Gravatar;

class UserProfileComposer {

	public function compose($view)
	{
		// $data = $view->getData();
		// $order = $data['order'];

		$gravatar = array(
			
			'src' => Gravatar::src(Auth::user()->email, 200),
			
		);

		$langs = getLocaleArray();

		$view->with('gravatar', $gravatar);
		$view->with('langs', $langs);
	}

}