<?php namespace Cvp\Repos\User;

use Cvp\Repos\DbBaseRepository;

class DbUserRepository extends DbBaseRepository implements UserRepository {
	
	/**
	 * @var User
	 */

	protected $model;

	function __construct(\User $model)
	{
		$this->model = $model;
	}

	/**
	 * Gets user data for tabular index
	 *
	 * @param  array  $input
	 * @return Model
	 */
	public function getUserIndex(array $input = null)
	{
		// sort by query string input

		if (array_key_exists('sortBy', $input) && array_key_exists('sortDirection', $input))
		{
			if ($input['sortDirection'] == 'asc' || $input['sortDirection'] == 'desc')
			{
				$output = $this->model->orderBy($input['sortBy'], $input['sortDirection']);
			}
		}
		else
		{
			$output = $this->model->orderBy('email', 'asc');
		}

		return $output->paginate(30);
	}

}