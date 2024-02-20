<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos_movimientos_contacto', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('pedido_id')->unsigned()->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->date('fecha')->nullable();
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_movimientos_contacto');
    }
};
