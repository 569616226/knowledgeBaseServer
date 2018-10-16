<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 255)->comment('广告名称');
            $table->string('path', 255)->comment('图片链接地址');
            $table->integer('type')->default(0)->comment('链接方式 0:外链，1内部跳转');
            $table->integer('order')->nullable()->comment('排序');
            $table->string('url', 255)->comment('内联地址 ');

            $table->unsignedInteger('user_id')->unsigned();
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
        Schema::drop('adverts');
    }
}
