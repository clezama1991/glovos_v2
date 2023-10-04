<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsExtrasToVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->BigInteger('tipo_nubosidad_id')->unsigned()->nullable()->after('globo_id');
            $table->foreign('tipo_nubosidad_id')->references('id')->on('tipo_nubosidad');
            $table->string('zona_despegue')->after('hora_aterrizaje')->nullable();
            $table->integer('altura_maxima')->nullable();
            $table->string('viento')->nullable();
            $table->text('notas_cancelacion')->nullable(); 
            $table->string('meteoblue_donwload')->after('parte_mateo')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->dropColumn('tipo_nubosidad_id','zona_despegue','altura_maxima','viento','notas_cancelacion','meteoblue_url','meteoblue_donwload');
        });
    }
}
