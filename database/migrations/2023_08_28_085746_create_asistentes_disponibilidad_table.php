<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistentesDisponibilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes_disponibilidad', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('asistente_id')->unsigned()->nullable();
            $table->foreign('asistente_id')->references('id')->on('asistentes');
            $table->BigInteger('turno_id')->unsigned()->nullable();
            $table->foreign('turno_id')->references('id')->on('turnos');
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
        Schema::dropIfExists('asistentes_disponibilidad');
    }
}
