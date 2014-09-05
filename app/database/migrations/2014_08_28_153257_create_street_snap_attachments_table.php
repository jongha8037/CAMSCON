<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetSnapAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('street_snap_attachments', function($table) {
			$table->bigIncrements('id');
			$table->bigInteger('snap_id')->unsigned();
			$table->string('caption')->nullable()->default(null);
			$table->string('original_name')->nullable();
			$table->string('original_extension',4);
			$table->string('mime_type');
			$table->integer('size')->unsigned();
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
			$table->string('dir_path');
			$table->string('filename');
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
		Schema::drop('street_snap_attachments');
	}

}
