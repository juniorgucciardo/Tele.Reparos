<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attends', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inicial');
            $table->dateTime('data_final');
            $table->foreignId('order_id')->unsigned()->nullable();
            $table->foreignId('status_id')->nullable()->unsigned()->default(1); //finalizado, andamento...
            $table->mediumText('description')->nullable();
            $table->timestamps();


            $table->foreign('order_id')->references('id')->on('orders')->onDelete('SET NULL');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attends');
    }
}
