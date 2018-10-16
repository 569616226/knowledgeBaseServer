<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('content')->nullable()->comemnt('回答内容');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
