<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id(); 
            $table->BigInteger('zona_id')->unsigned()->nullable();
            $table->foreign('zona_id')->references('id')->on('zones');
 
            $table->BigInteger('piloto_id')->unsigned()->nullable();
            $table->foreign('piloto_id')->references('id')->on('pilotos');
 
            $table->BigInteger('globo_id')->unsigned()->nullable();
            $table->foreign('globo_id')->references('id')->on('globos');
 
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('peso_total')->nullable();
            $table->integer('temperatura')->nullable();
            $table->string('parte_mateo')->nullable();
            $table->string('tabla_carga')->nullable();
            $table->integer('carga_total')->nullable();
            $table->integer('gas')->nullable();
            $table->text('notas')->nullable();
            $table->softDeletes(); 
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
        Schema::dropIfExists('vuelos');
    }
}
