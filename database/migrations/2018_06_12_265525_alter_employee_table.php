<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE `employees`
	CHANGE COLUMN `last_login` `last_login` DATETIME NULL AFTER `status`");
		DB::statement("ALTER TABLE `employees`
	CHANGE COLUMN `permanentAddress` `permanentAddress` TEXT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `localAddress`");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
