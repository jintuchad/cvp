<?php

use Illuminate\Database\Migrations\Migration;

class ModifyCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Add max_per_code column
		Schema::table('coupons', function($table) {
			$table->integer('max_per_code')->default(1)->after('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('coupons', function($table) {
			$table->dropColumn('max_per_code');
		});
	}

}
