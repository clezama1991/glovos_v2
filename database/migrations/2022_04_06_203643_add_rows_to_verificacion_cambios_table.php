<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToVerificacionCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verificacion_cambios', function (Blueprint $table) {
            $table->date('fecha_rev_2')->nullable();
            $table->string('nro_informe_rev_2')->nullable();
            $table->string('nro_referencia_rev_2')->nullable();
            $table->boolean('validacion_efectuo_cambio_rev_2')->nullable();
            $table->boolean('validacion_impacto_se_mantiene_rev_2')->nullable();
            $table->boolean('validacion_comunicacion_cambio_rev_2')->nullable();
            $table->boolean('validacion_medida_mitigacion_rev_2')->nullable();
            $table->text('observaciones_rev_2')->nullable();
            $table->string('verificado_responsable_rev_2')->nullable();
            $table->string('verificado_cargo_responsable_rev_2')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verificacion_cambios', function (Blueprint $table) {
            $table->dropColumn('fecha_rev_2');
            $table->dropColumn('nro_informe_rev_2');
            $table->dropColumn('nro_referencia_rev_2');
            $table->dropColumn('validacion_efectuo_cambio_rev_2');
            $table->dropColumn('validacion_impacto_se_mantiene_rev_2');
            $table->dropColumn('validacion_comunicacion_cambio_rev_2');
            $table->dropColumn('validacion_medida_mitigacion_rev_2');
            $table->dropColumn('observaciones_rev_2');
            $table->dropColumn('verificado_responsable_rev_2');
            $table->dropColumn('verificado_cargo_responsable_rev_2');
        });
    }
}
