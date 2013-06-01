<?php

use Illuminate\Database\Migrations\Migration;

class CreateGenresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genres', function($table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->timestamps();
		});

			DB::table('genres')->insert(array(
			'title'     => 'Electronic',
		));

			DB::table('genres')->insert(array(
			'title'     => 'HipHop',
		));

			DB::table('genres')->insert(array(
			'title'     => 'House',
		));

			DB::table('genres')->insert(array(
			'title'     => 'Drum&bass',
		));

			DB::table('genres')->insert(array(
			'title'     => 'Dubstep',
		));

			DB::table('genres')->insert(array(
			'title'     => 'Pop',
		));

			DB::table('genres')->insert(array(
			'title'     => 'Dance',
		));

			DB::table('genres')->insert(array(
			'title'     => 'Indie',
		));
		

		
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