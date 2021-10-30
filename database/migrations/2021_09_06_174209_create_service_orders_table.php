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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('rua_cliente');
            $table->char('numero_cliente', 10);
            $table->string('bairro_cliente');
            $table->string('cidade_cliente');
            $table->string('contato_cliente')->nullable();
            // ======= //

            $table->string('descricao_servico')->nullable();
            $table->date('data_ordem');
            $table->time('hora_ordem');
            $table->integer('recurrence')->nullable();
            $table->integer('months')->nullable();
            $table->char('insurance', 15)->nullable();
            $table->integer('duration')->default(4);
            $table->char('insurance_cod', 30)->nullable();
            
            

           


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
