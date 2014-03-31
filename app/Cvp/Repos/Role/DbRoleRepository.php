<?php namespace Cvp\Repos\Role;

use Cvp\Repos\DbBaseRepository;

class DbRoleRepository extends DbBaseRepository implements RoleRepository {
	
	/**
	 * @var Role
	 */

	protected $model;

	function __construct(\Role $model)
	{
		$this->model = $model;
	}

	/**
	 * Retrieves all roles equal or lesser in level to the specified level
	 *
	 * @param  int  $level
	 * @return Role
	 */
	public function allForAssignment($level = 0)
	{
		return $this->model->where('level', '<=', $level)->orderBy('level','asc')->get();
	}

}