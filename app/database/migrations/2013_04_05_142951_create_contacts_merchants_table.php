<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsMerchantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts_merchants', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('merchant_id');
			$table->integer('contact_id');
			$table->boolean('is_default')->default(false);
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
		Schema::drop('contacts_merchants');
	}

}