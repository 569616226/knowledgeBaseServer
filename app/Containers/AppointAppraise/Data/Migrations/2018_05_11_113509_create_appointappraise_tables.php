<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointAppraiseTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appoint_appraises', function (Blueprint $table) {

            $table->increments('id');
            $table->tinyInteger('star')->comment('行业专业度');
            $table->tinyInteger('degree')->comment('内容满意');
            $table->longText('content')->nullable()->comment('内容回顾');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->integer('appoint_id')->unsigned();
            $table->foreign('appoint_id')->references('id')->on('appoints')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('appoint_appraises');
    }
}
