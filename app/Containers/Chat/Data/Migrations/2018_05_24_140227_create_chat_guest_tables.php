<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatGuestTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chat_guest', function (Blueprint $table) {

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('chat_id')->unsigned();
            $table->foreign('chat_id')->references('id')->on('chats');

            $table->integer('is_sender')->default(0)->comment('0:收信人，1：发信人');
            $table->integer('reciver_or_sender_id')->nullable()->comment('收信人/发信人id');
            $table->integer('is_last')->default(1)->comment('是否最新');

            $table->primary(['guest_id', 'chat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('chat_guest');
    }
}
