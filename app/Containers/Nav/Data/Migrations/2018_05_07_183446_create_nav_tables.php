<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNavTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->comment('分类名称');
            $table->string('icon')->nullable()->comment('分类图标');
            $table->integer('pid')->default(0)->comment('分类父ID');
            $table->integer('user_id')->unsigned();//创建人
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('navs');
    }
}
