<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGloboQuemadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globo_quemadores', function (Blueprint $table) {
            $table->id();
            $table->string('fabricante')->nullable(); 
            $table->string('modelo')->nullable(); 
            $table->float('peso')->nullable(); 
            $table->string('nro_serie')->nullable(); 
            $table->date('CRS')->nullable(); 
            $table->date('fecha_mangueras')->nullable(); 
            $table->text('observaciones')->nullable(); 
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
        Schema::dropIfExists('globo_quemadores');
    }
}
