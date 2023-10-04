<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionRiesgosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_riesgos', function (Blueprint $table) {
            $table->id(); 
            $table->BigInteger('comunicacion_id')->unsigned()->nullable();
            $table->foreign('comunicacion_id')->references('id')->on('comunicacion_riesgos');
            $table->string('origen_metodo')->nullable(); 
            $table->date('fecha')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('naturaleza')->nullable(); 
            $table->string('ri_probabilidad')->nullable(); 
            $table->string('ri_severidad')->nullable(); 
            $table->string('ri_valor1')->nullable(); 
            $table->string('medidas_mitigacion')->nullable(); 
            $table->string('rf_probabilidad')->nullable(); 
            $table->string('rf_severidad')->nullable(); 
            $table->string('rf_valor1')->nullable(); 
            $table->date('fecha_efectividad')->nullable();
            $table->date('fecha_implementacion')->nullable();
            $table->date('fecha_seguimiento_control')->nullable();
            $table->string('responsable')->nullable();
            $table->string('ref_documentacion')->nullable();
            $table->text('notas')->nullable();
            $table->softDeletes(); 
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
        Schema::dropIfExists('vuelos');
    }
}
