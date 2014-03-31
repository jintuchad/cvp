<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrderdealoptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderdealoptions', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('dealoption_id');
			$table->string('voucher_code')->nullable()->default(null);
			$table->date('expiration_date')->nullable()->default(null);
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
		Schema::drop('orderdealoptions');
	}

}