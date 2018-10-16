<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title')->comment('标题');
            $table->string('sender')->comment('发送人');
            $table->string('group_name')->comment('接收人标签');
            $table->string('img_url')->nullable()->comment('消息图片');
            $table->longText('content')->comment('消息内容');
            $table->integer('msg_type')->default(0)->comment('消息类型: 0:系统消息，1:图文,2:文本');
            $table->boolean('is_read')->default(0)->comment('是否已读');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
