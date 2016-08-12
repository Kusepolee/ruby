<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relation_finance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table'); //表
            $table->integer('owner_id');
            $table->integer('default'); //默认
            $table->string('name');
            $table->string('account');
            $table->string('bank')->nullable();
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
        Schema::table('relation_finance', function (Blueprint $table) {
            //
        });
    }
}
