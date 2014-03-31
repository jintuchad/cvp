<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignConstraintsToUserTable extends Migration {

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
		
		Schema::table('role_user', function($table) use ($prefix)
		{
			$table->foreign('user_id')->references('id')->on($prefix.'users');
			$table->foreign('role_id')->references('id')->on($prefix.'roles');
		});

		Schema::table('permission_role', function($table) use ($prefix)
		{
			$table->foreign('permission_id')->references('id')->on($prefix.'permissions');
			$table->foreign('role_id')->references('id')->on($prefix.'roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_user', function($table)
		{
			$table->dropForeign('user_id');
			$table->dropForeign('role_id');
		});

		Schema::table('permission_role', function($table)
		{
			$table->dropForeign('permission_id');
			$table->dropForeign('role_id');
		});
	}

}
