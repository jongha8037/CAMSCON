<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimplePictorialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('simple_pictorials', function($table) {
			/*Primary key, Auto increment*/
			$table->bigIncrements('id');

			/*user relation*/
			$table->bigInteger('user_id')->unsigned();

			/*Model data*/
			$table->string('title')->nullable();
			$table->text('excerpt')->nullable();
			$table->text('text')->nullable();

			/*Cache data*/;
			$table->integer('cached_total_likes')->unsigned()->default(0);
			$table->integer('cached_total_comments')->unsigned()->default(0);

			/*Timestamps and status*/
			$table->enum('status', array('draft', 'published'))->default('draft');
			$table->timestamps();

			/*Indexes*/
			$table->index('user_id');
			$table->index('status');
			$table->index('cached_total_likes');
			$table->index('cached_total_comments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('simple_pictorials');
	}

}
