<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsObservacionesToPilotoEntrenamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos_entrenamientos', function (Blueprint $table) {
            $table->text('observaciones')->after('resultados')->nullable();
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
            $table->dropColumn('observaciones');
        });
    }
}
