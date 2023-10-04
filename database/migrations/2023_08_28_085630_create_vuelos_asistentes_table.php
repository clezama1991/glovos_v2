<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosAsistentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos_asistentes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('vuelo_id')->unsigned()->nullable();
            $table->foreign('vuelo_id')->references('id')->on('vuelos');
            $table->BigInteger('asistente_id')->unsigned()->nullable();
            $table->foreign('asistente_id')->references('id')->on('asistentes');
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('vuelos_asistentes');
    }
}
