<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosRealizadosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos_realizados', function (Blueprint $table) {
            $table->id(); 
            $table->longText('zona')->nullable(); 
            $table->longText('piloto')->nullable();
            $table->longText('globo')->nullable(); 
            $table->longText('vuelo')->nullable(); 
            $table->longText('pedido')->nullable(); 
            $table->longText('pasajeros')->nullable(); 
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
        Schema::dropIfExists('vuelos_realizados');
    }
}
