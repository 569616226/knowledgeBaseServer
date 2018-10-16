<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 20)->comment('菜单名称');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级id');
            $table->string('icon')->comment('图标');
            $table->string('url')->comment('路由');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
