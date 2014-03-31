<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealoptionsOrderitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealoptions_orderitems', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('dealoption_id');
			$table->integer('orderitem_id');
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
		Schema::drop('dealoptions_orderitems');
	}

}