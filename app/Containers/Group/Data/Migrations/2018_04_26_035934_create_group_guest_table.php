<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupGuestTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('group_guest', function (Blueprint $table) {


            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');

            $table->primary(['guest_id', 'group_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('group_guest');
    }
}
