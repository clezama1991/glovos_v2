<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosListaEsperaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_lista_espera', function (Blueprint $table) {
            $table->id();            
            $table->BigInteger('pedido_id')->unsigned()->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->json('zonas_id')->nullable();
            $table->json('dias')->nullable();
            $table->date('fecha_inicio_disp')->nullable();
            $table->date('fecha_fin_disp')->nullable();
            $table->date('fecha_inicio_nodisp')->nullable();
            $table->date('fecha_fin_nodisp')->nullable();
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
        Schema::dropIfExists('pedidos_lista_espera');
    }
}
