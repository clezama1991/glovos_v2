<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->date('fecha_despegue')->nullable()->after('notas');
            $table->time('hora_despegue')->nullable()->after('notas');
            $table->time('hora_aterrizaje')->nullable()->after('notas');
            $table->time('duracion_vuelo')->nullable()->after('notas');
            $table->string('lugar_despegue')->nullable()->after('notas');
            $table->string('lugar_aterrizaje')->nullable()->after('notas');
            $table->boolean('cautivo')->default(0)->nullable()->after('notas');
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
            $table->dropColumn('fecha_despegue');
            $table->dropColumn('hora_despegue');
            $table->dropColumn('hora_aterrizaje');
            $table->dropColumn('duracion_vuelo');
            $table->dropColumn('lugar_despegue');
            $table->dropColumn('lugar_aterrizaje');
            $table->dropColumn('cautivo');
        });
    }
}
