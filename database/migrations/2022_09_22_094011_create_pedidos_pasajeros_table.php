<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosPasajerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_pasajeros', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('pedido_id')->unsigned()->nullable(); 
            $table->BigInteger('pasajero_id')->unsigned()->nullable(); 
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
        Schema::dropIfExists('pedidos_pasajeros');
    }
}
