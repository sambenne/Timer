<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			// auto increment id (primary key)
			$table->increments('id');

			$table->string('email');
			$table->string('password', 64);
			$table->string('name', 32);

			$table->string('remember_token', 100)->nullable();

			$table->unique('email', 'users_email_unique');

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
		Schema::drop('users');
	}

}
