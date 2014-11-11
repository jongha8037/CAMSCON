<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_comments', function($table) {
			$table->enum('deleted_by', array('user', 'admin'))->nullable()->after('cached_total_likes');
			$table->softDeletes()->after('deleted_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_comments', function($table) {
			$table->dropColumn(array('deleted_by', 'deleted_at'));
		});
	}

}
