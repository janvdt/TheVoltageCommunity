<?php

use Illuminate\Database\Migrations\Migration;

class CreateMusicpostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->text('body');
			$table->integer('image_id');
			$table->string('type');
			$table->text('soundcloud');
			$table->integer('soundcloud_id');
			$table->text('youtube');
			$table->string('soundcloud_art');
			$table->string('youtube_art');
			$table->integer('views');
			$table->integer('postlikes');
			$table->integer('created_by');
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
		Schema::drop('posts');
	}

}