<?php namespace Cvp\Mailers;

use Crypt;

class UserMailer extends Mailer {

	public function verify(\User $user)
	{
		$view = 'emails.user.verify';
		$data = array(
			'crypt_user_id' => Crypt::encrypt($user->id),
		);
		$subject = 'Please verify your account';

		return $this->sendTo($user, $subject, $view, $data);
	}

	public function verified(\User $user)
	{
		$view = 'emails.user.verified';
		$data = array();
		$subject = 'Your account has been verified';

		return $this->sendTo($user, $subject, $view, $data);
	}

}