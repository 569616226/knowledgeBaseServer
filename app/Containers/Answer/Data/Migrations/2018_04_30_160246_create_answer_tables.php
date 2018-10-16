<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswerTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->comment('问题标题');
            $table->tinyInteger('status')->default(3)->comment('问题状态：0:待回答 ，1：已回答，2：已关闭,3：待付款');
            $table->double('price',12,2)->default(0)->comment('问题金额');
            $table->integer('star')->nullable()->comment('问题评价');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
