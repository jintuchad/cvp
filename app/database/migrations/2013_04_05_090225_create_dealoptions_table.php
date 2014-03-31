<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealoptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealoptions', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('deal_id');
			$table->string('name')->default('');
			$table->boolean('needs_voucher')->default(true);
			$table->boolean('custom_code')->default(false);
			$table->integer('order');
			$table->boolean('active');
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
		Schema::drop('dealoptions');
	}

}