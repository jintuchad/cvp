<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrderitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderitems', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('description');
			$table->integer('vendor_id');
			$table->integer('unit_price');
			$table->integer('retail_value');
			$table->integer('req_shipping')->default(0);
			$table->integer('default_freight_charge')->default(0);
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
		Schema::drop('orderitems');
	}

}