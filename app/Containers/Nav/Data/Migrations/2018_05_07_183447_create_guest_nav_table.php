<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuestNavTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guest_nav', function (Blueprint $table) {


            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests');

            $table->integer('nav_id')->unsigned();
            $table->foreign('nav_id')->references('id')->on('navs');

            $table->primary(['guest_id', 'nav_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('guest_nav');
    }
}
