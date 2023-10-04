<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaCargaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_carga', function (Blueprint $table) {
            $table->id();   
            $table->string('modelo_globo')->nullable(); 
            $table->integer('fift_inits_10')->nullable(); 
            $table->integer('fift_inits_11')->nullable(); 
            $table->integer('fift_inits_12')->nullable(); 
            $table->integer('fift_inits_13')->nullable(); 
            $table->integer('fift_inits_14')->nullable(); 
            $table->integer('fift_inits_15')->nullable(); 
            $table->integer('fift_inits_16')->nullable(); 
            $table->integer('fift_inits_17')->nullable(); 
            $table->integer('fift_inits_18')->nullable(); 
            $table->integer('fift_inits_19')->nullable(); 
            $table->integer('fift_inits_20')->nullable(); 
            $table->integer('fift_inits_21')->nullable(); 
            $table->integer('fift_inits_22')->nullable(); 
            $table->integer('fift_inits_23')->nullable(); 
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
        Schema::dropIfExists('tabla_carga');
    }
}
