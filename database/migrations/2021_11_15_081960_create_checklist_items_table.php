<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_concluted')->default(0);
            $table->foreignId('checklist_id');
            $table->dateTime('concluted_at')->nullable();
            $table->foreignId('concluted_by')->nullable();
            $table->foreignId('type_id');
            $table->timestamps();


            $table->foreign('checklist_id')->references('id')->on('checklists')->onDelete('cascade');
            $table->foreign('concluted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('checklist_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklist_items');
    }
}
