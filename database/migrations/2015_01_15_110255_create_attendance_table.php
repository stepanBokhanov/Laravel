<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('employeeID',20);
			$table->index('employeeID');
			$table->foreign('employeeID')
      			  ->references('employeeID')->on('employees')
      			  ->onUpdate('cascade')
      			  ->onDelete('cascade');

      		$table->date('date');
            $table->enum('status',array('absent','present'));
            $table->string('leaveType',100)->nullable();
            $table->string('halfDayType',100)->nullable();

      		$table->text('reason')->nullable();
            $table->enum('application_status',array('approved','rejected','pending'))->nullable();
            $table->date('applied_on')->nullable();
			$table->string('updated_by',100)->nullable();

            $table->index('leaveType');
            $table->foreign('leaveType')
                ->references('leaveType')->on('leavetypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

			$table->index('updated_by');
			$table->foreign('updated_by')
			      ->references('email')->on('admins')
			      ->onUpdate('cascade')
			      ->onDelete('cascade');

			$table->index('halfDayType');
			$table->foreign('halfDayType')
				->references('leaveType')->on('leavetypes')
				->onUpdate('cascade')
				->onDelete('cascade');

            $table->unique(['employeeID','date']);


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
		Schema::drop('attendance');
	}

}
