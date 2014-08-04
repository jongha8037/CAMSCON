<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facebook_accounts', function($table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id');
			$table->bigInteger('fb_id')->unsigned();
			$table->string('email')->nullable();
			$table->string('name')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('link')->nullable();
			$table->string('gender')->nullable();
			$table->string('locale')->nullable();
			$table->integer('age_range_min')->unsigned()->nullable();
			$table->integer('age_range_max')->unsigned()->nullable();
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
		Schema::drop('facebook_accounts');
	}

}
