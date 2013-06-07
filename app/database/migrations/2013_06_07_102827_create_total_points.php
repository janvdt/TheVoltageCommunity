<?php

use Illuminate\Database\Migrations\Migration;

class CreateTotalPoints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('totalpoints', function($table)
		{
			$table->increments('id');
			$table->integer('value');
			$table->integer('account_id');
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
		Schema::drop('totalpoints');
	}

}