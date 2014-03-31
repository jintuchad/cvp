<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUsermetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// move usermeta info to users table
		DB::raw('update users u join usermeta um on um.user_id = u.id set u.default_city_id = um.default_city_id, u.last_login = um.last_login');

		Schema::drop('usermeta');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
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
	}

}
