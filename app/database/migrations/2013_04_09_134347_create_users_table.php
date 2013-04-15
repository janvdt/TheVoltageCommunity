<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('email', 64);
			$table->string('password', 64);
			$table->string('first_name', 128);
			$table->string('last_name', 128);
			$table->string('role', 255);
			$table->string('status', 255);
			$table->boolean('master');
			$table->timestamps();
		});

		DB::table('users')->insert(array(
			'email'     => 'janvandertaelen@gmail.com',
			'password'  => Hash::make('pukkelpop'),
			'first_name' => 'Jan',
			'master'     => 1,
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}