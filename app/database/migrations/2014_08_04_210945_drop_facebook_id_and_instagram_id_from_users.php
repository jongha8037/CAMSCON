<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFacebookIdAndInstagramIdFromUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->dropColumn(array('facebook_id', 'instagram_id'));
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
			$table->bigInteger('facebook_id')->unsigned()->after('nickname');
			$table->bigInteger('instagram_id')->unsigned()->after('facebook_id');
		});
	}

}
