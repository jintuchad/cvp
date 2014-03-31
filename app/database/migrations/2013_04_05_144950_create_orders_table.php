<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('shipping_contact_id')->default(0);
			$table->integer('freight_charge')->default(0);
			$table->integer('is_gift')->default(0);
			$table->string('reference_no')->nullable()->default(null);
			$table->date('date_shipped')->nullable()->default(null);
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
		Schema::drop('orders');
	}

}