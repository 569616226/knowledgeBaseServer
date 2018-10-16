<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->comment('订单名称');
            $table->string('order_no')->comment('订单号');
            $table->double('price',12,2)->comment('价格');
            $table->tinyInteger('status')->default(2)->comment('状态 "0: 已关闭 ，1：已付款 ，2：待付款 , 3:退款中，4：已退款,5:已完成 6:支付失败"');
            $table->dateTime('pay_time')->nullable()->comment('付款时间');
            $table->integer('pay_type')->default(0)->nullable()->comment('支付方式 ： ‘0：微信支付’');

            $table->tinyInteger('answer_type')->nullable()->comment('问答类型 0 :提问 1：查看问题');

            $table->tinyInteger('is_cancel')->default(0)->comment('是否是违约金订单');
            $table->integer('cancel_appoint_id')->nullable()->comment('违约金订单對應訂單id');
            $table->string('cancel_res')->nullable()->comment('违约金订单 取消原因');
            $table->string('payee')->nullable()->comment('违约金订单 收款人');

            $table->tinyInteger('refund_status')->nullable()->comment('转账状态 0：转账失败 1：转账成功 2：待转账');
            $table->tinyInteger('refund_type')->nullable()->comment('退款类型 0：约见取消退款 1：问题关闭退款');
            $table->tinyInteger('refund_way')->nullable()->comment('退款方式 0：原路退回 1：微信钱包');
            $table->string('refund_remark')->nullable()->comment('退款备注');

            $table->string('refund_auditor')->nullable()->comment('审核人');
            $table->tinyInteger('refund_audit_status')->nullable()->comment('审核状态 0:审核失败 1：审核通过 2:待审核');
            $table->dateTime('refund_audit_time')->nullable()->comment('审核时间');
            $table->string('refund_audit_remark')->nullable()->comment('审核备注');

            $table->integer('guest_id')->unsigned();//违约金订单 取消人
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->integer('appoint_id')->nullable()->unsigned();//約見
            $table->foreign('appoint_id')->references('id')->on('appoints')->onDelete('cascade');

            $table->integer('answer_id')->nullable()->unsigned();//問答
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
