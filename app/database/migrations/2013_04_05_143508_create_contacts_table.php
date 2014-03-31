<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('firstname')->nullable()->default(null);
			$table->string('lastname')->nullable()->default(null);
			$table->string('address1')->nullable()->default(null);
			$table->string('address2')->nullable()->default(null);
			$table->string('city')->nullable()->default(null);
			$table->integer('state_id')->nullable()->default(null);
			$table->string('zipcode')->nullable()->default(null);
			$table->string('phone')->nullable()->default(null);
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
		Schema::drop('contacts');
	}

}