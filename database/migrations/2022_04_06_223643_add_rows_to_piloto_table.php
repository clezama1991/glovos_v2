<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToPilotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            $table->date('vuelo_if')->nullable();
            $table->string('vuelo_if_doc')->nullable();
            $table->date('experiencia_reciente')->nullable();
            $table->string('experiencia_reciente_doc')->nullable();
            $table->boolean('hab_cautivos')->default(0)->nullable();
            $table->boolean('hab_nocturnos')->default(0)->nullable();
            $table->enum('habilitacion_nivel',['A','B','C','D'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            $table->dropColumn('vuelo_if');
            $table->dropColumn('vuelo_if_doc');
            $table->dropColumn('experiencia_reciente');
            $table->dropColumn('experiencia_reciente_doc');
            $table->dropColumn('hab_cautivos');
            $table->dropColumn('hab_nocturnos');
            $table->dropColumn('habilitacion_nivel');
        });
    }
}
