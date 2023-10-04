<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosMovimientosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_movimientos', function (Blueprint $table) {
            $table->id();  
            $table->BigInteger('pedido_id')->unsigned()->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->BigInteger('vuelo_id')->unsigned()->nullable();
            $table->foreign('vuelo_id')->references('id')->on('vuelos');
            $table->date('fecha')->nullable(); 
            $table->text('observacion')->nullable(); 
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
        Schema::dropIfExists('pedidos_movimientos');
    }
}
