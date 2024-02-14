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
        Schema::create('globo_diferido', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('globo_cuadricula_id')->unsigned()->nullable();
            $table->foreign('globo_cuadricula_id')->references('id')->on('globo_cuadricula');
            
            $table->BigInteger('creado_por')->unsigned()->nullable();
            $table->foreign('creado_por')->references('id')->on('users');
            $table->text('detalle')->nullable();
            $table->text('adjunto1')->nullable();
            $table->text('adjunto2')->nullable();
            $table->text('adjunto3')->nullable();
            $table->text('adjunto4')->nullable();
            $table->text('adjunto5')->nullable();
            
            $table->text('gravedad')->nullable();

            $table->boolean('solucionado')->default(0);
            $table->BigInteger('solucionado_por')->unsigned()->nullable();
            $table->foreign('solucionado_por')->references('id')->on('users');
            $table->text('solucionado_detalle')->nullable();
            $table->text('solucionadoadjunto1')->nullable();
            $table->text('solucionadoadjunto2')->nullable();
            $table->text('solucionadoadjunto3')->nullable();
            $table->text('solucionadoadjunto4')->nullable();
            $table->text('solucionadoadjunto5')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('globo_diferido');
    }
};
