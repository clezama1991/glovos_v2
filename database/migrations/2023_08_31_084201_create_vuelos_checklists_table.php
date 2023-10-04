<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos_checklists', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('checklist_id')->unsigned()->nullable();
            $table->foreign('checklist_id')->references('id')->on('checklist');
            $table->boolean('checked_list');
            $table->BigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->BigInteger('vuelo_id')->unsigned()->nullable();
            $table->foreign('vuelo_id')->references('id')->on('vuelos');
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
        Schema::dropIfExists('vuelos_checklists');
    }
}
