<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealtabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealtabs', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('deal_id');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->integer('order');
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
		Schema::drop('dealtabs');
	}

}