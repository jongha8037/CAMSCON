<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazineMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('magazine_meta', function($table) {
			$table->increments('id');
			
			$table->string('name_ko')->nullable();
			$table->string('name_en')->nullable();
			$table->string('name_ja')->nullable();
			$table->string('name_zh_cn')->nullable();
			$table->string('name_zh_tw')->nullable();
			$table->string('name_ru')->nullable();
			$table->string('name_th')->nullable();
			$table->string('name_es')->nullable();
			$table->string('name_vi')->nullable();

			$table->text('url');
			$table->text('description');
			$table->string('slug');

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
		Schema::drop('magazine_meta');
	}

}
