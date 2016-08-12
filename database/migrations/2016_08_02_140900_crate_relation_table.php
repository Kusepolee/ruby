<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table'); //表
            $table->integer('owner_id');
            $table->integer('default'); //是否默认
            $table->integer('state'); //状态
            $table->string('addr')->nullable(); //地址
            $table->string('post_code')->nullable(); //邮编
            $table->string('tel')->nullable(); //电话
            $table->string('fax')->nullable(); //传真
            $table->string('email')->nullable(); //邮件
            $table->integer('email_confirmed')->nullable(); //邮件
            $table->string('web')->nullable(); //网站 
            $table->string('mobile')->nullable(); //手机
            $table->integer('mobile_confirmed')->nullable(); //手机
            $table->string('wechat')->nullable(); //微信
            $table->string('qq')->nullable();
            $table->string('content')->nullable(); //备注
            $table->integer('create_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relations', function (Blueprint $table) {
            //
        });
    }
}
