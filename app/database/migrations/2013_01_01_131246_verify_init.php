<?php
use Illuminate\Database\Migrations\Migration;

class VerifyInit extends Migration {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('smee::prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Bring to local scope
		$prefix = $this->prefix;

		// Create the permissions table
		Schema::create($prefix.'permissions', function($table)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id');
			$table->string('name', 100)->index();
			$table->string('description', 255)->nullable();
			$table->timestamps();
		});

		// Create the roles table
		Schema::create($prefix.'roles', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('name', 100)->index();
			$table->string('description', 255)->nullable();
			$table->integer('level');
			$table->timestamps();
		});

		// Create the users table
		Schema::create($prefix.'users', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('username', 30)->index();
			$table->string('password', 60)->index();
			$table->string('salt', 32);
			$table->string('email', 255)->index();
			$table->boolean('verified')->default(0);
			$table->boolean('disabled')->default(0);
			$table->dateTime('deleted_at')->nullable()->index();
			$table->timestamps();
		});

		// Create the role/user relationship table
		Schema::create($prefix.'role_user', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';

			$table->integer('user_id')->unsigned()->index();
			$table->integer('role_id')->unsigned()->index();
			$table->timestamps();

			// $table->foreign('user_id')->references('id')->on($prefix.'users');
			// $table->foreign('role_id')->references('id')->on($prefix.'roles');
		});

		// Create the permission/role relationship table
		Schema::create($prefix.'permission_role', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';

			$table->integer('permission_id')->unsigned()->index();
			$table->integer('role_id')->unsigned()->index();
			$table->timestamps();

			// $table->foreign('permission_id')->references('id')->on($prefix.'permissions');
			// $table->foreign('role_id')->references('id')->on($prefix.'roles');
		});

		// create the usermeta table
		Schema::create('usermeta', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('user_id');
			$table->integer('default_city_id')->default(0);
			$table->dateTime('last_login')->nullable()->default(null);
			$table->timestamps();
		});

		// create the 'super admin' role
		// $role_id = DB::table($prefix.'roles')->insertGetId(array(
  //           'name' => Config::get('verify::super_admin'),
  //           'level' => 10,
  //           'created_at' => date('Y-m-d H:i:s'),
  //           'updated_at' => date('Y-m-d H:i:s')
  //       ));

		// // create an admin
  //       $user_id = DB::table($prefix.'users')->insertGetId(array(
  //           'username' => 'chadmazilly@gmail.com',
  //           'password' => '$2a$08$rqN6idpy0FwezH72fQcdqunbJp7GJVm8j94atsTOqCeuNvc3PzH3m',
  //           'salt' => 'a227383075861e775d0af6281ea05a49',
  //           'email' => 'chadmazilly@gmail.com',
  //           'created_at' => date('Y-m-d H:i:s'),
  //           'updated_at' => date('Y-m-d H:i:s'),
  //           'verified' => 1,
  //           'disabled' => 0,
  //           'deleted_at' => null
  //       ));

   //      // assign the admin the 'super admin' role
   //      DB::table($prefix.'role_user')->insert(array(
   //          'role_id' => $role_id,
   //          'user_id' => $user_id,
   //          'created_at' => date('Y-m-d H:i:s'),
   //          'updated_at' => date('Y-m-d H:i:s')
   //      ));

   //      // create meta data for this user
   //      DB::table('usermeta')->insert(array(
   //          'user_id' => $user_id,
			// 'default_city_id' => 0,
			// 'created_at' => date('Y-m-d H:i:s'),
   //      ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usermeta');
		Schema::drop($this->prefix.'role_user');
		Schema::drop($this->prefix.'permission_role');
		Schema::drop($this->prefix.'users');
		Schema::drop($this->prefix.'roles');
		Schema::drop($this->prefix.'permissions');
	}

}
