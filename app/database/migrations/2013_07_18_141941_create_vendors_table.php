<?php

use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->string('phone')->default('');
			$table->string('website')->default('');
			$table->text('notes')->default('');
			$table->boolean('active')->default(false);
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
		Schema::drop('vendors');
	}

}