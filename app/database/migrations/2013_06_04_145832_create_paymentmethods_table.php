<?php

use Illuminate\Database\Migrations\Migration;

class CreatePaymentmethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paymentmethods', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->integer('active')->default(1);
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
		Schema::drop('paymentmethods');
	}

}