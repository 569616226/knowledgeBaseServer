
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appoints', function (Blueprint $table) {

            $table->increments('id');
            $table->tinyInteger('case_id')->nullable()->comment('学员选择的方案');
            $table->tinyInteger('status')->default(1)->comment('状态 “0：已关闭/取消，1：待付款 ，2：待确认 ，3：待见面，4：待评价，5：已完成，6：已拒绝”');
            $table->string('status_times')->nullable()->comment('约见状态时间');
            $table->string('cancel_res')->nullable()->comment('取消原因');
            $table->string('canceler')->nullable()->comment('取消人');
            $table->longText('answers')->nullable()->comment('学员提的问题(array');
            $table->longText('profile')->nullable()->comment('学员自我介绍');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('appoints');
    }
}
