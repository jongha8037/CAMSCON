<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campus_meta', function($table) {
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
			$table->string('slug');

			$table->timestamps();
			$table->unique('slug');
		});

		Schema::create('street_meta', function($table) {
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
			$table->string('slug');

			$table->timestamps();
			$table->unique('slug');
		});

		Schema::create('fashion_week_meta', function($table) {
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
			$table->string('slug');

			$table->timestamps();
			$table->unique('slug');
		});

		Schema::create('festival_meta', function($table) {
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
			$table->string('slug');

			$table->timestamps();
			$table->unique('slug');
		});

		Schema::create('club_meta', function($table) {
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
			$table->string('slug');

			$table->timestamps();
			$table->unique('slug');
		});

		Schema::create('blog_meta', function($table) {
			$table->increments('id');
			
			$table->string('name');
			$table->string('slug');
			$table->text('url');
			$table->text('description');

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
		Schema::drop('campus_meta');
		Schema::drop('street_meta');
		Schema::drop('fashion_week_meta');
		Schema::drop('festival_meta');
		Schema::drop('club_meta');
		Schema::drop('blog_meta');
	}

}
