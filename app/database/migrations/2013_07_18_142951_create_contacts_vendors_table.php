<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts_vendors', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('vendor_id');
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
		Schema::drop('contacts_vendors');
	}

}