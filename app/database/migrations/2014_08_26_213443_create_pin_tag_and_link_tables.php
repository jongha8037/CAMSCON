<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinTagAndLinkTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pin_tags', function($table) {
			$table->bigIncrements('id');
			$table->bigInteger('target_id')->unsigned();
			$table->string('target_type');
			$table->decimal('top',7,2)->unsigned();
			$table->decimal('left',7,2)->unsigned();
			$table->integer('brand_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->timestamps();

			$table->index('target_id');
			$table->index('target_type');
		});

		Schema::create('pin_links', function($table) {
			$table->bigIncrements('id');
			$table->bigInteger('pin_id')->unsigned();
			$table->enum('pin_link_type', array('user','camscon','partner','sponsor','etc'));
			$table->string('title');
			$table->text('url');
			$table->timestamps();

			$table->index('pin_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pin_tags');
		Schema::drop('pin_links');
	}

}
