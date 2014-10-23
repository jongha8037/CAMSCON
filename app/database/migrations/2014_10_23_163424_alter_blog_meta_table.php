<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlogMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blog_meta', function($table) {
			$table->bigInteger('user_id')->after('id');
			$table->char('country_code', 2)->after('description');

			$table->index('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blog_meta', function($table) {
			$table->dropColumn(array('user_id', 'country_code'));
		});
	}

}
