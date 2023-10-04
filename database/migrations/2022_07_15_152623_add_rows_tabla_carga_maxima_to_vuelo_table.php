<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsTablaCargaMaximaToVueloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->integer('tabla_carga_maxima')->nullable();
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
            $table->dropColumn('tabla_carga_maxima');
        });
    }
}
