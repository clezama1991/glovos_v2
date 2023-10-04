<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosCanceladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos_cancelados', function (Blueprint $table) {
            $table->id();
            $table->json('zona')->nullable(); 
            $table->json('piloto')->nullable();
            $table->json('globo')->nullable(); 
            $table->json('vuelo')->nullable(); 
            $table->json('pedido')->nullable(); 
            $table->json('pasajeros')->nullable(); 
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
        Schema::dropIfExists('vuelos_cancelados');
    }
}
