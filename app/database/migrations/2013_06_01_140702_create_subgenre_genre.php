<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubgenreGenre extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subgenre_genre', function($table)
		{
			$table->increments('id');
			$table->integer('genre_id');
			$table->integer('subgenre_id');
			$table->integer('post_id');
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