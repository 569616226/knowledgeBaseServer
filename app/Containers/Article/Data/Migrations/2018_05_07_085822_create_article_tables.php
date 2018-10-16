<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleTables extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title', 255)->comment('标题');
            $table->longText('content')->comment('内容');
            $table->string('cover', 255)->comment('文章封面');
            $table->integer('status')->default(2)->comment('状态 “0：审核失败 ，1：审核通过 ，2：待审核”');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->string('auditor')->nullable()->comment('审核人');
            $table->dateTime('audit_time')->nullable()->comment('审核时间');
            $table->integer('readers')->default(0)->comment('阅读量');
            $table->string('like')->nullable()->comment('点赞数');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('articles');
    }
}
