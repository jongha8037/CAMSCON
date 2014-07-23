<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFashionBrandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fashion_brands', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description')->nullable();
			$table->text('url')->nullable;
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
		Schema::drop('fashion_brands');
	}

}
