<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceOrderRelacionships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('id_service'); //jardinagem, limpeza...
            $table->foreignId('type_id')->nullable()->unsigned()->default(1); //contrato, avulso...
            

            //atribuição das referencias 
            $table->foreign('id_service')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
        });

            
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

