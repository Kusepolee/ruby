<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vip_id'); //供应商编号
            $table->string('nic_name')->nullable(); //简称
            $table->string('name'); //名称
            $table->string('img'); //名称
            $table->integer('type'); //类型
            $table->integer('state'); //状态
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
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
}
