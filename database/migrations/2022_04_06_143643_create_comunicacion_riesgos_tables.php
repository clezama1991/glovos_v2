<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunicacionRiesgosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicacion_riesgos', function (Blueprint $table) {
            $table->id();  
            $table->integer('codigo')->nullable();
            $table->date('fecha')->nullable();
            $table->string('estado')->nullable();
            $table->string('nombres_notificante')->nullable();
            $table->string('url_firma_notificante')->nullable();
            $table->string('cargo_responsabilidad_notificante')->nullable();
            $table->text('descripción_suceso')->nullable();
            $table->text('medidas_correctivas')->nullable();
            $table->string('nombres_responsable')->nullable();
            $table->string('url_firma_responsable')->nullable();
            $table->string('url_documentos_sucesos')->nullable();
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
