<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToGloboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('globos', function (Blueprint $table) {
            $table->enum('habilitacion_nivel',['A','B','C','D'])->nullable();
            $table->string('certiricado_aeronavegabilidad_doc')->nullable();
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
            $table->dropColumn('habilitacion_nivel');
            $table->dropColumn('certiricado_aeronavegabilidad_doc');
        });
    }
}
