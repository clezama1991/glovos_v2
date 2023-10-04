<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsZonasDespeguesToZones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->string('nombre_despegue_1')->after('url_despegue_1')->nullable();
            $table->string('nombre_despegue_2')->after('url_despegue_2')->nullable();
            $table->string('nombre_despegue_3')->nullable();
            $table->string('url_despegue_3')->nullable();
            $table->string('nombre_despegue_4')->nullable();
            $table->string('url_despegue_4')->nullable();
            $table->string('nombre_despegue_5')->nullable();
            $table->string('url_despegue_5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn('nombre_despegue_1','nombre_despegue_2','nombre_despegue_3','url_despegue_3','nombre_despegue_4','url_despegue_4','nombre_despegue_5','url_despegue_5');
        });
    }
}
