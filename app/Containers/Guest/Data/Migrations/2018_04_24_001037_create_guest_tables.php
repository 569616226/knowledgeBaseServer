<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuestTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {

            $table->increments('id');
            $table->string('open_id')->unique()->comment('微信id');
            $table->string('name')->comment('姓名');
            $table->string('real_name')->nullable()->comment('真实姓名');
            $table->string('password')->nullable();
            $table->string('avatar')->comment('头像');
            $table->string('phone', 13)->nullable()->comment('手机');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('we_name')->nullable()->comment('微信号');
            $table->string('city')->nullable()->comment('所在地');
            $table->string('single_profile')->nullable()->comment('一句话介绍');
            $table->string('office')->nullable()->comment('任职机构');
            $table->string('cover')->nullable()->comment('封面');
            $table->string('location')->nullable()->comment('所在区域 (可以选)');
            $table->string('card_id')->nullable()->unique()->comment('身份证号码');
            $table->string('card_pic')->nullable()->comment('身份证手持照');
            $table->string('referee')->nullable()->comment('推荐人名称');
            $table->string('like_linkas')->nullable()->comment('我喜欢的大咖');
            $table->string('viewed_linkas')->nullable()->comment('我浏览过的大咖');
            $table->double('wallets',null,2)->default(0)->comment('钱包金额');
            $table->string('remark')->nullable()->comment('备注');
            $table->string('auditor')->nullable()->comment('审核人');
            $table->dateTime('audit_time')->nullable()->comment('审核人时间');
            $table->longText('profile')->nullable()->comment('个人介绍');
            $table->tinyInteger('status')->default(3)->comment('大咖审核状态 “0：失败，1：成功 ，2：待审核 ，3：普通用户”');
            $table->tinyInteger('gender')->default(2)->comment('性别 "0：未知 ，1：男 ，2：女"');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('guests');
    }
}
