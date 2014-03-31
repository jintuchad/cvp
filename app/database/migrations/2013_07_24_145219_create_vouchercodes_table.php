<?php

use Illuminate\Database\Migrations\Migration;

class CreateVouchercodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchercodes', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('dealoption_id');
			$table->string('code');
			$table->boolean('used')->default(false);
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
		Schema::drop('vouchercodes');
	}

}