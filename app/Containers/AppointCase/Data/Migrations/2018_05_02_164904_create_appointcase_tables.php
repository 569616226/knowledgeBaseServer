<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointCaseTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appoint_cases', function (Blueprint $table) {

            $table->increments('id');
            $table->dateTime('appoint_time')->comment('约见方案时间');
            $table->string('location')->nullable()->comment('约见地点，全国通话没有地点');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->integer('appoint_id')->unsigned();
            $table->foreign('appoint_id')->references('id')->on('appoints')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('appoint_cases');
    }
}
