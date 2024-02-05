<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilotosEntrenamientosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilotos_entrenamientos', function (Blueprint $table) {
            $table->id();  
            $table->BigInteger('piloto_id')->unsigned()->nullable();
            $table->foreign('piloto_id')->references('id')->on('pilotos');
            $table->BigInteger('globo_id')->unsigned()->nullable();
            $table->foreign('globo_id')->references('id')->on('globos');
            $table->string('modelo_globo')->nullable();
            $table->string('marca_globo')->nullable();
            $table->string('matricula_globo')->nullable();            
            $table->date('fecha')->nullable(); 
            $table->string('responsable')->nullable(); 
            $table->string('resultados')->nullable(); 
            $table->string('estatus')->default('Asignado')->nullable(); 
            $table->longText('entrenamiento')->nullable(); 
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilotos_entrenamientos');
    }
}
