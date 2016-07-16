<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_or_t');
            $table->decimal('tran_amount', 15 ,5)->nullable();
            $table->integer('tran_from');
            $table->integer('tran_to');
            $table->integer('tran_type');
            $table->string('tran_item');
            $table->string('tran_date');
            $table->integer('tran_state');
            $table->integer('createdBy');
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
        Schema::drop('finance_trans');
    }
}
