<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsActivoToVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {            
            $table->boolean('activo')->default(1);
            $table->string('estatus')->default('Creado')->nullable();
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
            $table->dropColumn('activo','estatus');
         });
    }
}
