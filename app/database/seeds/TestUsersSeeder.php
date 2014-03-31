<?php

class TestUsersSeeder extends Seeder {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('smee::prefix', '');
	}

	public function run()
	{
		// Bring to local scope
		$prefix = $this->prefix;

		## create roles

		$role_super_admin_id = 1;

		$role_moderator_id = DB::table($prefix.'roles')->insertGetId(array(
			'name' => 'Moderator',
			'level' => 2,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$role_admin_id = DB::table($prefix.'roles')->insertGetId(array(
			'name' => 'Admin',
			'level' => 5,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$role_admin_plus_id = DB::table($prefix.'roles')->insertGetId(array(
			'name' => 'AdminPlus',
			'level' => 6,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## create permissions

		// user functions

		$permission_view_user_id = DB::table($prefix.'permissions')->insertGetId(array(
			'name' => 'view_user',
			'description' => 'View user',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$permission_create_user_id = DB::table($prefix.'permissions')->insertGetId(array(
			'name' => 'create_user',
			'description' => 'Create user',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$permission_edit_user_id = DB::table($prefix.'permissions')->insertGetId(array(
			'name' => 'edit_user',
			'description' => 'Edit user',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$permission_delete_user_id = DB::table($prefix.'permissions')->insertGetId(array(
			'name' => 'delete_user',
			'description' => 'Delete user',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		$permission_change_user_password_id = DB::table($prefix.'permissions')->insertGetId(array(
			'name' => 'change_user_password',
			'description' => 'Change user password',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## link roles and permissions

		// super admin

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_view_user_id,
			'role_id' => $role_super_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_create_user_id,
			'role_id' => $role_super_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_edit_user_id,
			'role_id' => $role_super_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_delete_user_id,
			'role_id' => $role_super_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_change_user_password_id,
			'role_id' => $role_super_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		// admin plus

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_view_user_id,
			'role_id' => $role_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_create_user_id,
			'role_id' => $role_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_edit_user_id,
			'role_id' => $role_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_delete_user_id,
			'role_id' => $role_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_change_user_password_id,
			'role_id' => $role_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		// admin

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_view_user_id,
			'role_id' => $role_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_create_user_id,
			'role_id' => $role_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_edit_user_id,
			'role_id' => $role_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		// moderator

		DB::table($prefix.'permission_role')->insert(array(
			'permission_id' => $permission_view_user_id,
			'role_id' => $role_moderator_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Base User

		$user_base_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'user@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'user@cvp.com',
			'verified' => 1,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Moderator

		$user_mod_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'moderator@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'moderator@cvp.com',
			'verified' => 1,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'role_user')->insert(array(
			'role_id' => $role_moderator_id,
			'user_id' => $user_mod_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Admin

		$user_admin_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'admin@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'admin@cvp.com',
			'verified' => 1,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'role_user')->insert(array(
			'role_id' => $role_admin_id,
			'user_id' => $user_admin_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Admin+

		$user_admin_plus_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'adminplus@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'adminplus@cvp.com',
			'verified' => 1,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		DB::table($prefix.'role_user')->insert(array(
			'role_id' => $role_admin_plus_id,
			'user_id' => $user_admin_plus_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Unverified

		$user_unverified_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'unverified@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'unverified@cvp.com',
			'verified' => 0,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Disabled

		$user_disabled_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'disabled@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'disabled@cvp.com',
			'verified' => 1,
			'disabled' => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));

		## Deleted

		$user_deleted_id = DB::table($prefix.'users')->insertGetId(array(
			'username' => 'deleted@cvp.com',
			'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
			'salt' => 'a227383075861e775d0af6281ea05a49',
			'email' => 'deleted@cvp.com',
			'verified' => 1,
			'disabled' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => date('Y-m-d H:i:s')
		));
	}

}