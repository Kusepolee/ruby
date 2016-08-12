<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('amount', 15, 5);
            $table->integer('unit');
            $table->string('sender');
            $table->string('receiver');
            $table->string('company');
            $table->string('content');
            $table->string('date');
            $table->integer('created_by');
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
        Schema::drop('delivery');
    }
}
