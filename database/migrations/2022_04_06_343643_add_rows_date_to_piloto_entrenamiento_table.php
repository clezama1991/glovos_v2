<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsDateToPilotoEntrenamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos_entrenamientos', function (Blueprint $table) {
            $table->date('fecha_aplicacion')->nullable();
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
            $table->dropColumn('fecha_aplicacion');
        });
    }
}
