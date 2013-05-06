<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostViewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_view', function($table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('view_id');
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
		Schema::drop('post_view');
	}

}