<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('gender')->nullable()->comment('性别');
            $table->string('birth')->nullable()->comment('生日');
            $table->string('device')->nullable()->comment('方法');
            $table->string('platform')->nullable()->comment('平台');
            $table->boolean('is_client')->default(false);
            $table->boolean('is_frozen')->default(false)->commnet('冻结/解冻');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
