<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFinaceTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('finaces', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->comment('交易名称');
            $table->string('order_name')->comment('订单名称');
            $table->string('order_no')->comment('订单号');
            $table->double('price',12,2)->comment('价格');
            $table->tinyInteger('type')->comment('交易类型 "0: 回答问题收入 ，1：约见学员收入，2：约见大咖收入，3：问答被查看收入4：收到违约金 5：提现金额');

            $table->integer('guest_id')->unsigned();//违约金订单 取消人
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('finaces');
    }
}
