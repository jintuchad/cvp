<?php

use Chadmazilly\Smee\Models\User as SmeeUser;

class User extends SmeeUser {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('username', 'password', 'salt', 'email', 'verified', 'deleted_at', 'disabled', 'created_by', 'updated_by', 'deleted_by', 'last_login', 'locale');

	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = array('_token', 'submitted');

	/**
	 * Getter: last_login
	 *
	 * @var value
	 */
	public function getLastLoginAttribute($value)
    {
        return (is_null($value)) ? null : \Carbon\Carbon::createFromTimeStamp(strtotime($value));
    }

}