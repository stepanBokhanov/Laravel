<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('website',100);
			$table->string('email',100);
			$table->string('name',100);
			$table->string('logo',100);
			$table->string('currency',20);
			$table->string('currency_icon',100);
            $table->enum('award_notification', ['1', '0']);
            $table->enum('attendance_notification', ['1', '0']);
            $table->enum('leave_notification', ['1', '0']);
            $table->enum('notice_notification', ['1', '0']);
            $table->enum('employee_add', ['1', '0']);

            // Email Configuration
            $table->enum('mail_driver',['smtp','mail'])->default('mail');
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->enum('mail_encryption',['tls','ssl'])->default('tls');

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
		Schema::drop('settings');
	}

}
