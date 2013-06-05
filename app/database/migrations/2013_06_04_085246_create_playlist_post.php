<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlaylistPost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlist_post', function($table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('playlist_id');
			$table->integer('position_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('playlist_post');
	}

}