<?php namespace Cvp\Repos\User;

use Cvp\Repos\BaseRepository;

interface UserRepository extends BaseRepository {
	
	public function getUserIndex(array $input = null);

}