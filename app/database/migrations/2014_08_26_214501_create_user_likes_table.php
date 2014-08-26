<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_likes', function($table) {
			$table->bigIncrements('id');
			$table->string('target_type');			
			$table->bigInteger('target_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->timestamps();

			$table->index('target_type');
			$table->index('target_id');
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
		Schema::drop('user_likes');
	}

}
