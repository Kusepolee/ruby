<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->string('name');
            $table->string('password');
            $table->integer('gender')->nullable();
            $table->string('department'); //部门
            $table->string('position'); //职位
            $table->integer('state');
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
        Schema::table('supplier_users', function (Blueprint $table) {
            //
        });
    }
}
