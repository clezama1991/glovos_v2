<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsFormsToPilotoEntrenamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos_entrenamientos', function (Blueprint $table) {
            $table->BigInteger('formulario_id')->unsigned()->nullable();
            $table->foreign('formulario_id')->references('id')->on('formularios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pilotos_entrenamientos', function (Blueprint $table) {
            $table->dropColumn('formulario_id');
        });
    }
}
