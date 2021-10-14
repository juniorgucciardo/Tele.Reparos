<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('img_contract');
            $table->foreignId('contract_id');
            $table->timestamps();

            //references
            $table->foreign('contract_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_contracts');
    }
}
