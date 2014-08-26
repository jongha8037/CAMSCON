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
			$table->bigIncrements('id');
			/*Icon data*/
			$table->bigInteger('icon_id');
			
			/*Timestamps*/
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
		//
	}

}

/*DB*/
id
updated_at
created_at
deleted_at

/*Icon data*/
icon_id
icon_name
icon_sex
icon_profession
icon_age
icon_comment

/*Content data*/
primary_photo_id
attachments_array

/*Meta data*/
content_type_id
meta_id
total_likes
total_comments


/*Photographer data*/
user_id
photographer_comment