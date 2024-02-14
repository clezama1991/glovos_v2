<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsZonasMsgPeronsalizadosToZones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->string('msg_despegue_1')->after('url_despegue_2')->nullable(); 
            $table->string('msg_despegue_2')->after('despegue_whatsapp')->nullable(); 
            $table->string('msg_despegue_3')->after('nombre_despegue_4')->nullable(); 
            $table->string('msg_despegue_4')->after('nombre_despegue_5')->nullable(); 
            $table->string('msg_despegue_5')->after('icao')->nullable(); 
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
            $table->dropColumn('msg_despegue_1','msg_despegue_2','msg_despegue_3','msg_despegue_4','msg_despegue_5');
        });
    }
}
