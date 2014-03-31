<?php

use Illuminate\Database\Migrations\Migration;

class AddRevisionInfoToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permissions', function($table)
		{
			$table->softDeletes();

			$table->integer('created_by')->default(0)->unsigned();
			$table->integer('updated_by')->nullable()->unsigned();
			$table->integer('deleted_by')->nullable()->unsigned();
		});

		Schema::table('roles', function($table)
		{
			$table->softDeletes();
			
			$table->integer('created_by')->default(0)->unsigned();
			$table->integer('updated_by')->nullable()->unsigned();
			$table->integer('deleted_by')->nullable()->unsigned();
		});

		Schema::table('users', function($table)
		{
			$table->integer('created_by')->default(0)->unsigned();
			$table->integer('updated_by')->nullable()->unsigned();
			$table->integer('deleted_by')->nullable()->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permissions', function($table)
		{
			$table->dropColumn('deleted_at');
			$table->dropColumn('created_by');
			$table->dropColumn('updated_by');
			$table->dropColumn('deleted_by');
		});

		Schema::table('roles', function($table)
		{
			$table->dropColumn('deleted_at');
			$table->dropColumn('created_by');
			$table->dropColumn('updated_by');
			$table->dropColumn('deleted_by');
		});

		Schema::table('users', function($table)
		{
			$table->dropColumn('created_by');
			$table->dropColumn('updated_by');
			$table->dropColumn('deleted_by');
		});
	}

}