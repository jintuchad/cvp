<?php

use Chadmazilly\Smee\Models\Role as SmeeRole;

class Role extends SmeeRole {

	/**
	 * Soft delete
	 *
	 * @var boolean
	 */
	protected $softDelete = true;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('name', 'description', 'level', 'deleted_at', 'created_by', 'updated_by', 'deleted_by');

}