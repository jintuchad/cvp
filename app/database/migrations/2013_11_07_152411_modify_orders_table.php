<?php

use Illuminate\Database\Migrations\Migration;

class ModifyOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Add confirmed column
		Schema::table('orders', function($table) {
			$table->integer('confirmed')->default(0)->after('reference_no');
		});

		// update all current orders to confirmed status
		DB::table('orders')->update(array('confirmed' => 1));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function($table) {
			$table->dropColumn('confirmed');
		});
	}

}
