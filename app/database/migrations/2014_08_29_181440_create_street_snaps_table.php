<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetSnapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('street_snaps', function($table) {
			/*Primary key, Auto increment*/
			$table->bigIncrements('id');
			
			/*Subject data*/
			$table->bigInteger('subject_id')->unsigned()->nullable();
			$table->string('name');
			$table->enum('gender', array('male', 'female'));
			$table->integer('birthyear')->unsigned()->nullable();
			$table->string('affiliation')->nullable();
			$table->text('subject_comment')->nullable();
			
			/*Image content data*/
			/*Not needed
			$table->bigInteger('primary_photo_id')->unsigned()->nullable();
			$table->string('attachments_array')->nullable();
			*/

			/*Meta data*/
			$table->integer('meta_id')->unsigned();
			$table->string('meta_type');
			$table->integer('cached_total_likes')->unsigned()->default(0);
			$table->integer('cached_total_comments')->unsigned()->default(0);
			$table->enum('season', array('S/S','F/W'));

			/*Photographer data*/
			$table->bigInteger('user_id')->unsigned();
			$table->text('photographer_comment')->nullable();

			/*Timestamps & status*/
			$table->timestamps();
			$table->enum('status', array('draft', 'published'));

			/*Indexes*/
			$table->index('name');
			$table->index('meta_id');
			$table->index('meta_type');
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
		Schema::drop('street_snaps');
	}

}
