<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFashionItemCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fashion_item_categories', function($table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0);
			$table->string('name_en');
			$table->string('name_ko')->nullable();
			$table->string('name_ja')->nullable();
			$table->string('name_zh_cn')->nullable();
			$table->string('name_zh_tw')->nullable();
			$table->string('name_ru')->nullable();
			$table->string('name_th')->nullable();
			$table->string('name_es')->nullable();
			$table->string('name_vi')->nullable();
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
		Schema::drop('fashion_item_categories');
	}

}
