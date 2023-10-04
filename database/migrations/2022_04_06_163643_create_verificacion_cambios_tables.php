<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionCambiosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificacion_cambios', function (Blueprint $table) {
            $table->id(); 
            $table->BigInteger('comunicacion_id')->unsigned()->nullable();
            $table->foreign('comunicacion_id')->references('id')->on('comunicacion_riesgos');
            $table->date('fecha')->nullable();
            $table->string('nro_informe')->nullable();
            $table->string('nro_referencia')->nullable();
            $table->boolean('validacion_efectuo_cambio')->nullable();
            $table->boolean('validacion_impacto_se_mantiene')->nullable();
            $table->boolean('validacion_comunicacion_cambio')->nullable();
            $table->boolean('validacion_medida_mitigacion')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('verificado_responsable')->nullable();
            $table->string('verificado_cargo_responsable')->nullable();
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
