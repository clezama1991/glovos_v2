<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsMtomToTablaCargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabla_carga', function (Blueprint $table) {            
            $table->string('mtom')->nullable();
            $table->string('min_mtom')->nullable();
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
            $table->dropColumn('mtom','min_mtom');
        });
    }
}
