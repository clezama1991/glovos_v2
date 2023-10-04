<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();             
            $table->BigInteger('padre_id')->unsigned()->nullable();
            $table->foreign('padre_id')->references('id')->on('formularios');
            $table->string('codigo')->nullable(); 
            $table->text('nombre')->nullable(); 
            $table->string('descripcion')->nullable(); 
            $table->enum('tipo',['formulario','seccion','pregunta'])->default('formulario')->nullable();
            $table->string('valor')->nullable();
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
        Schema::dropIfExists('formularios');
    }
}
