<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGloboBottomEndsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globo_bottom_ends', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(); 
            $table->string('bottom_end')->nullable(); 
            $table->json('compatibilidad_globos_ids')->nullable(); 
            $table->BigInteger('cesta_id')->unsigned()->nullable();
            $table->foreign('cesta_id')->references('id')->on('globo_cestas');
            $table->BigInteger('quemador_id')->unsigned()->nullable();
            $table->foreign('quemador_id')->references('id')->on('globo_quemadores');
            $table->json('botella_id')->nullable();
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
        Schema::dropIfExists('globo_bottom_ends');
    }
}
