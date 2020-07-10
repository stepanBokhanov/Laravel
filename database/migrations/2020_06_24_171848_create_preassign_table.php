<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreassignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preassign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeID',20);
            $table->index('employeeID');
            $table->foreign('employeeID')
                  ->references('employeeID')->on('employees')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('preassign_holidays')->default(0);
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
        Schema::dropIfExists('preassign');
    }
}
