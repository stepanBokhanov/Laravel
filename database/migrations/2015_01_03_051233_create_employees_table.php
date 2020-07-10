<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeID', 20)->unique()->nullable();
			$table->string('fullName', 100);
			$table->string('email', 150)->unique();
			$table->string('password', 100);
			$table->enum('gender',['male','female']);
			$table->string('fatherName', 100)->nullable();
			$table->string('mobileNumber', 20)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->integer('designation')->unsigned()->nullable();
			$table->date('joiningDate')->nullable();
			$table->string('profileImage')->default('default.jpg')->nullable();
			$table->text('localAddress')->nullable();
			$table->text('permanentAddress')->nullable();
			$table->enum('status',['active','inactive']);
			$table->dateTime('last_login')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->date('exit_date')->nullable();

			$table->foreign('designation')
			      ->references('id')->on('designation')
			      ->onUpdate('cascade')
			      ->onDelete('cascade');
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
		Schema::drop('employees');
	}

}
