<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionPlataformaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('configuracion_global_plataforma', function (Blueprint $table) {            
            $table->id();
            $table->string('key'); 
            $table->string('tipo'); 
            $table->string('nombre'); 
            $table->string('descripcion'); 
            $table->text('valor'); 
            $table->string('grupo'); 
            $table->boolean('visible')->default(false); 
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
        Schema::dropIfExists('configuracion_global_plataforma');
    }
}
