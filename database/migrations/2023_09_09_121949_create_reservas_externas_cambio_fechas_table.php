<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasExternasCambioFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_externas_cambio_fechas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('reserva_externa_id')->unsigned()->nullable();
            $table->foreign('reserva_externa_id')->references('id')->on('reservas_externas');
            $table->date('fecha')->nullable();
            $table->integer('zona')->nullable();
            $table->boolean('aceptada_admin')->default(false);
            $table->boolean('aceptada_user')->default(false);
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
        Schema::dropIfExists('reservas_externas_cambio_fechas');
    }
}
