<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')->comment('私信内容');
            $table->integer('is_read')->default(0)->comment('是否已读');
            $table->integer('pid')->comment('父id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('chats');
    }
}
