<?php namespace Cvp\Mailers;

use Mail;

abstract class Mailer {

	public function sendTo($user, $subject, $view, $data = array())
	{
		Mail::send($view, $data, function($message) use($user, $subject)
		{
			$message->to($user->email)->subject($subject);
		});
	}

}