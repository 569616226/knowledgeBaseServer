<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuestMessageTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guest_message', function (Blueprint $table) {

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('message_id')->unsigned();
            $table->foreign('message_id')->references('id')->on('messages');

            $table->primary(['guest_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('guest_message');
    }
}
