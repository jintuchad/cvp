<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserCreatorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user-create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new user.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$email = $this->argument('email');
		$password = $this->argument('password');

		$user = new User;
		$user->username = $email;
		$user->password = $password;
		$user->email = $email;
		$user->verified = 1;
		$user->disabled = 0;
		$user->save();

		$this->info('User created!');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('email', InputArgument::REQUIRED, 'Email address'),
			array('password', InputArgument::REQUIRED, 'Desired password'),
		);
	}

}