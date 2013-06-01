<?php

use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function($table)
		{
			$table->increments('id');
			$table->text('body');
			$table->integer('post_id');
			$table->integer('user_id');
			$table->integer('account_id');
			$table->integer('message_id');
			$table->boolean('viewed');
			$table->integer('post_creator');
			$table->boolean('activity');
			$table->integer('type');
			$table->text('text');
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
		Schema::drop('notifications');
	}

}