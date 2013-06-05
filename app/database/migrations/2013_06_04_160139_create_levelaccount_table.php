<?php

use Illuminate\Database\Migrations\Migration;

class CreateLevelaccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('level_account', function($table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('level_id');
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
		Schema::drop('level_account');
	}

}