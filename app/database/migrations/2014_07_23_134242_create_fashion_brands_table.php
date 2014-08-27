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
			$table->string('name_en');
			$table->string('name_ko')->nullable();
			$table->string('name_ja')->nullable();
			$table->string('name_zh_cn')->nullable();
			$table->string('name_zh_tw')->nullable();
			$table->string('name_ru')->nullable();
			$table->string('name_th')->nullable();
			$table->string('name_es')->nullable();
			$table->string('name_vi')->nullable();
			$table->string('slug');
			$table->text('description')->nullable();
			$table->text('url')->nullable;
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
		Schema::drop('fashion_brands');
	}

}
