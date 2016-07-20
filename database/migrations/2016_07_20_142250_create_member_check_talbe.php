<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberCheckTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_check', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('deviceid');
            $table->decimal('latitude', 30, 20);
            $table->decimal('longitude', 30, 20);
            $table->decimal('speed', 15, 5);
            $table->decimal('accuracy', 15, 5);
            $table->integer('type');
            $table->string('content');
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
        Schema::drop('member_check');
    }
}
