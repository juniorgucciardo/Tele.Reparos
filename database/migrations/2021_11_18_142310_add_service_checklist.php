<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceChecklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklists', function (Blueprint $table){
            $table->foreignId('service_id')->nullable();
            $table->foreignId('contract_type_id')->nullable();


            $table->foreign('service_id')->references('id')->on('services')->onDelete('SET NULL');
            $table->foreign('contract_type_id')->references('id')->on('type')->onDelete('SET NULL');
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
