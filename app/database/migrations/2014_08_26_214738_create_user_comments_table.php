<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_comments', function($table) {
			$table->bigIncrements('id');
			$table->string('target_type');			
			$table->bigInteger('target_id')->unsigned();
			$table->bigInteger('parent_id')->unsigned();
			$table->text('comment');
			$table->bigInteger('user_id')->unsigned();
			$table->integer('cached_total_likes')->unsigned();
			$table->timestamps();

			$table->index('target_type');
			$table->index('target_id');
			$table->index('parent_id');
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
		Schema::drop('user_comments');
	}

}
