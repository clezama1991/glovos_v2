<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsFabricanteToTablaCargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabla_carga', function (Blueprint $table) {
            $table->string('fabricante')->after('modelo_globo')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabla_carga', function (Blueprint $table) {
            $table->dropColumn('fabricante');
        });
    }
}
