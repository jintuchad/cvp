<?php

use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('paymentmethod_id');
			$table->integer('amount');
			$table->integer('cc_type_id')->default(0);
			$table->string('cc_lastfour')->nullable()->default(null);
			$table->string('cc_exp_month')->nullable()->default(null);
			$table->string('cc_exp_year')->nullable()->default(null);
			$table->integer('cc_billcontact_id')->default(0);
			$table->integer('coupon_id')->default(0);
			$table->integer('couponcode_id')->default(0);
			$table->string('cc_reference_no')->nullable()->default(null);
			$table->string('cc_transaction_tag')->nullable()->default(null);
			$table->string('cc_authorization_num')->nullable()->default(null);
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
		Schema::drop('payments');
	}

}
