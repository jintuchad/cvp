<?php

use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('description');
			$table->integer('coupontype_id');
			$table->integer('value');
			$table->integer('max_per_order')->default(1);
			$table->integer('max_per_user')->default(1);
			$table->integer('is_exclusive_to_order')->default(0);
			$table->date('expiration_date')->default('0000-00-00');
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
		Schema::drop('coupons');
	}

}
