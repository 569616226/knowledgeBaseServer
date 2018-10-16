<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswerGuestTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answer_guest', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('answers');

            $table->unsignedTinyInteger('is_creator')->default(0)->comment('创建问题');
            $table->unsignedTinyInteger('is_reader')->default(0)->comment('查看问题');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answer_guest');
    }
}
