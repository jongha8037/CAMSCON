<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimplePictorialAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('simple_pictorial_attachments', function($table) {
			$table->bigIncrements('id');
			$table->bigInteger('pictorial_id')->unsigned();
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
		Schema::drop('simple_pictorial_attachments');
	}

}
