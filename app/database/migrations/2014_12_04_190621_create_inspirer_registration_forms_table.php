<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspirerRegistrationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inspirer_registration_forms', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('nickname');
			$table->string('mobile');
			$table->string('email');
			$table->string('website')->nullable();
			$table->string('blog')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('camscon_id');
			$table->enum('status', array('pending_approval', 'approved', 'declined'))->default('pending_approval');
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
		Schema::drop('inspirer_registration_forms');
	}

}
