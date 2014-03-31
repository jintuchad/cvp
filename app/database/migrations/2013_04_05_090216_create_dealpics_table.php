<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealpicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealpics', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('filename');
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
		Schema::drop('dealpics');
	}

}