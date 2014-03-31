<?php

use Chadmazilly\Smee\Models\Permission as SmeePermission;

class Permission extends SmeePermission {

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
	protected $fillable = array('name', 'description', 'deleted_at', 'created_by', 'updated_by', 'deleted_by');

}