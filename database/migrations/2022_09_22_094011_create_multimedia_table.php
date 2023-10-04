<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedias', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('vuelo_id')->unsigned()->nullable();
            $table->foreign('vuelo_id')->references('id')->on('vuelos');            
            $table->string('nombre')->nullable();
            $table->string('extension')->nullable();
            $table->string('carpeta')->nullable();
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('multimedias');
    }
}
