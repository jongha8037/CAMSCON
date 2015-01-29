<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorialPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('editorial_posts', function($table) {
			/*Primary key, Auto increment*/
			$table->bigIncrements('id');

			/*category relation*/
			$table->integer('category_id')->unsigned();

			/*content relation*/
			$table->bigInteger('content_id')->unsigned();
			$table->string('content_type');

			/*user relation*/
			$table->bigInteger('user_id')->unsigned();

			/*Model data*/
			$table->string('title')->nullable();
			$table->text('excerpt')->nullable();

			/*Cache data*/;
			$table->integer('cached_total_likes')->unsigned()->default(0);
			$table->integer('cached_total_comments')->unsigned()->default(0);

			/*Timestamps and status*/
			$table->timestamps();
			$table->enum('status', array('draft', 'published'))->default('draft');

			/*Indexes*/
			$table->index('category_id');
			$table->index('content_type');
			$table->index('user_id');
			$table->index('cached_total_likes');
			$table->index('cached_total_comments');
			$table->index('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('editorial_posts');
	}

}
