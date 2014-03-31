<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts_users', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('contact_id');
			$table->boolean('default_ship')->default(false);
			$table->boolean('default_bill')->default(false);
			$table->boolean('show_in_ship')->default(true);
			$table->boolean('show_in_bill')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts_users');
	}

}