<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeavetypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leavetypes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('leaveType',100);
            $table->unsignedInteger('num_of_leave');
			$table->index('leaveType');

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
		Schema::drop('leavetypes');
	}

}
