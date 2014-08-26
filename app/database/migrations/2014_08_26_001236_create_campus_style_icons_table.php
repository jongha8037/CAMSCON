<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusStyleIconsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campus_style_icons', function($table) {
			/*Primary key, Auto increment*/
			$table->bigIncrements('id');
			
			/*Icon data*/
			$table->bigInteger('icon_id')->unsigned()->nullable();
			$table->string('icon_name');
			$table->enum('icon_gender', array('male', 'female'));
			$table->integer('icon_age')->unsigned()->nullable();
			$table->text('icon_comment')->nullable();
			
			/*Image content data*/
			$table->bigInteger('primary_photo_id')->unsigned()->nullable();
			$table->string('attachments_array')->nullable();

			/*Meta data*/
			$table->integer('content_type_id')->unsigned();
			$table->integer('cached_total_likes')->unsigned();
			$table->integer('cached_total_comments')->unsigned();

			/*Photographer data*/
			$table->bigInteger('user_id')->unsigned();
			$table->text('photographer_comment')->nullable();

			/*Timestamps & status*/
			$table->timestamps();
			$table->enum('status', array('draft', 'published'));

			/*Indexes*/
			$table->index('icon_name');
			$table->index('content_type_id');
			$table->index('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campus_style_icons');
	}

}