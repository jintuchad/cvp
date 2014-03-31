<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deals', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('slug')->unique();
			$table->string('name');
			$table->string('heading');
			$table->text('fine_print')->default('');
			$table->text('instructions')->default('');
			$table->integer('max_purchase')->default(0);
			$table->integer('max_gift')->default(0);
			$table->boolean('expires')->default(false);
			$table->string('expiration_type')->nullable()->default(null);
			$table->integer('expiration_time')->nullable()->default(null);
			$table->date('expiration_date')->nullable()->default(null);
			$table->integer('merchant_id');
			$table->integer('dealcategory_id');
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
		Schema::drop('deals');
	}

}