<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrderdealoptionsOrderitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderdealoptions_orderitems', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('orderdealoption_id');
			$table->integer('orderitem_id');
			$table->integer('unit_price')->default(0);
			$table->integer('req_shipping')->default(0);
			$table->integer('freight_charge')->default(0);
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
		Schema::drop('orderdealoptions_orderitems');
	}

}