<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salary', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('employeeID',20);
            $table->index('employeeID');
            $table->foreign('employeeID')
                ->references('employeeID')->on('employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type',100);
            $table->double('salary',10);
            $table->string('remarks');

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
		Schema::drop('salary');
	}

}
