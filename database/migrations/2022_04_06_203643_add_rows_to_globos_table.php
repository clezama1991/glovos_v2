<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToGlobosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('globos', function (Blueprint $table) {
             
            $table->time('horas_iniciales')->nullable()->after('notas');
            $table->time('hora_finales')->nullable()->after('notas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('globos', function (Blueprint $table) {
            $table->dropColumn('horas_iniciales');
            $table->dropColumn('hora_finales');
        });
    }
}
