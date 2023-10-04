<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasExternasBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_externas_bitacoras', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('reserva_externa_id')->unsigned()->nullable();
            $table->foreign('reserva_externa_id')->references('id')->on('reservas_externas');
            $table->BigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');            
            $table->string('estatus')->nullable();
            $table->text('observacion')->nullable();            
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
        Schema::dropIfExists('reservas_externas_bitacoras');
    }
}
