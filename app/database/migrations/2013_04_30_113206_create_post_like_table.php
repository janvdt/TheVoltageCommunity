<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostLikeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_like', function($table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('like_id');
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
		Schema::drop('post_like');
	}

}