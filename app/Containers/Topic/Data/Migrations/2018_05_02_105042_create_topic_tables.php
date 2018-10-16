<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('status')->default(2)->comment('状态 “0：审核失败 ，1：审核通过 ，2：待审核”');
            $table->string('title')->comment('标题');
            $table->longText('describe')->comment('服务介绍');
            $table->double('price',12,2)->comment('价格');
            $table->integer('ser_time')->default(1)->comment('服务时长（小时）');
            $table->tinyInteger('ser_type')->default(0)->comment('服务类型 “0：线下约见，1: 全国通话”');
            $table->longText('need_infos')->nullable()->comment('学员需要提供什么信息(array）');
            $table->string('remark')->nullable()->comment('备注');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
