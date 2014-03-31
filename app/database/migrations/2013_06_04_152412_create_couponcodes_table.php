<?php

use Illuminate\Database\Migrations\Migration;

class CreateCouponcodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('couponcodes', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('coupon_id');
			$table->string('code');
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
		Schema::drop('couponcodes');
	}

}
