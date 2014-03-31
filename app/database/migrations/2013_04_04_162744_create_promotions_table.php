<?php

use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotions', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('city_id');
			$table->integer('deal_id');
			$table->date('startdate')->nullable();
			$table->date('enddate')->nullable();
			$table->integer('sales_boost')->default(0);
			$table->boolean('active')->default(true);
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
		Schema::drop('promotions');
	}

}