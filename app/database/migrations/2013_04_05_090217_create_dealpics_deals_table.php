<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealpicsDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealpics_deals', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('deal_id');
			$table->integer('dealpic_id');
			$table->boolean('is_listthumb')->default(false);
			$table->boolean('is_feature')->default(false);
			$table->integer('order_feature')->default(0);
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
		Schema::drop('dealpics_deals');
	}

}