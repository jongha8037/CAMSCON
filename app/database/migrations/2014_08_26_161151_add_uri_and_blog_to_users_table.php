<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUriAndBlogToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->string('uri')->nullable()->after('gender');
			$table->string('blog')->nullable()->after('uri');
			$table->index('uri');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function() {
			$table->dropColumn(array('uri', 'blog'));
		});
	}

}
