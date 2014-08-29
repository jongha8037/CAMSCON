<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->bigIncrements('id');
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('nickname');
			$table->enum('gender',array('male', 'female'))->nullable();
			$table->string('uri')->nullable();
			$table->string('blog')->nullable();
			$table->string('instagram')->nullable();
			$table->string('slug')->nullable();
			$table->softDeletes();
			$table->rememberToken();
			$table->timestamps();

			$table->unique('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
