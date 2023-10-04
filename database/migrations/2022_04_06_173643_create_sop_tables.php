<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sop', function (Blueprint $table) {
            $table->id();  
            $table->integer('codigo')->nullable();
            $table->date('fecha')->nullable();
            $table->string('nombre')->nullable();
            $table->string('name_file')->nullable();
            $table->string('url_file')->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('vuelos');
    }
}
