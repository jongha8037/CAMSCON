<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->dropColumn('email');
			$table->dropColumn('password');
		});

		Schema::table('users', function($table) {
			$table->string('email')->nullable()->after('id');
			$table->string('password')->nullable()->after('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
			$table->dropColumn('email');
			$table->dropColumn('password');
		});

		Schema::table('users', function($table) {
			$table->string('email')->after('id');
			$table->string('password')->after('email');
		});
	}

}
