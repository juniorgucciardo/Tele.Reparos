<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statuslog_id');
            $table->string('img_log'); //caminho onde a imagem vai ser salva
            $table->timestamps();

            $table->foreign('statuslog_id')->references('id')->on('status_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_logs');
    }
}
