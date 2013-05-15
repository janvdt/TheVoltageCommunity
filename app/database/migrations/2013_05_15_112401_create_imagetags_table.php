<?php

use Illuminate\Database\Migrations\Migration;

class CreateImagetagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_genre', function($table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('genre_id');
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