<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bank_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeID',20);

			$table->index('employeeID');
			$table->foreign('employeeID')
      			  ->references('employeeID')->on('employees')
      			  ->onUpdate('cascade')
      			  ->onDelete('cascade');

			$table->string('accountName',100);
			$table->string('accountNumber',40);
			$table->string('bank',100);
			$table->string('pan',10);
			$table->string('branch',100);
			$table->string('ifsc',20);

      			 
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
		Schema::drop('bank_details');
	}

}
