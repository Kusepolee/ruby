<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id'); //用户
            $table->string('name'); //姓名
            $table->string('password'); //密码
            $table->integer('gender')->nullable(); //性别 
            $table->string('department'); //部门
            $table->string('position'); //职位
            $table->integer('state'); //状态
            $table->integer('create_by');
            $table->string('content')->nullable();
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
        Schema::table('customer_users', function (Blueprint $table) {
            //
        });
    }
}
