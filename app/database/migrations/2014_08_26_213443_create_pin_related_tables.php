<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinRelatedTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('style_icon_pins', function($table) {
			$table->bigIncrements('id');
			$table->integer('top')->unsigned();
			$table->integer('left')->unsigned();
			$table->bigInteger('style_icon_id')->unsigned();
			$table->bigInteger('style_icon_photo_id')->unsigned();
			$table->integer('fashion_brand_id')->unsigned();
			$table->integer('fashion_item_category_id')->unsigned();
			$table->integer('fashion_item_id')->unsigned();
			$table->timestamps();

			$table->index('style_icon_id');
			$table->index('style_icon_photo_id');
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
		Schema::drop('style_icon_pins');
		Schema::drop('pin_links');
	}

}
