<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('rua_cliente');
            $table->string('numero_cliente');
            $table->string('bairro_cliente');
            $table->string('cidade_cliente');
            $table->string('contato_cliente');
            $table->string('descricao_servico');
            $table->date('data_ordem');
            $table->time('hora_ordem');

           


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
        Schema::dropIfExists('service_orders');
    }
}
