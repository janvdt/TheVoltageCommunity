<?php

use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function($table) {
			$table->increments('id');
			$table->string('biography');
			$table->integer('image_id');
			$table->integer('identifier');
			$table->string('facebookpic');
			$table->integer('point_id');
			$table->timestamps();
		});

		DB::table('accounts')->insert(array(
			'biography'     => 'fresh install',
			
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
	}

}