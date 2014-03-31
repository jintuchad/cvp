<?php namespace Cvp\Repos\Role;

use Cvp\Repos\BaseRepository;

interface RoleRepository extends BaseRepository {
	
	public function allForAssignment($level = 0);

}