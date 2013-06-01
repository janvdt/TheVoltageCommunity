<?php

use Illuminate\Database\Migrations\Migration;

class CreateTastesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tastes', function($table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->string('name',255);
			$table->string('value',255);
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
		Schema::frop('tastes');
	}

}