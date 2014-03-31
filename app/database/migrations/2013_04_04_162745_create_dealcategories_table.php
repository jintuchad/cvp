<?php

use Illuminate\Database\Migrations\Migration;

class CreateDealcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealcategories', function($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->unique();
			$table->integer('order');
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
		Schema::drop('dealcategories');
	}

}