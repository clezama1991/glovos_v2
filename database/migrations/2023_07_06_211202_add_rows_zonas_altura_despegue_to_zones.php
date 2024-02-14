<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsZonasAlturaDespegueToZones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->string('altura_despegue_1')->nullable(); 
            $table->string('altura_despegue_2')->nullable(); 
            $table->string('altura_despegue_3')->nullable(); 
            $table->string('altura_despegue_4')->nullable(); 
            $table->string('altura_despegue_5')->nullable(); 
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
            $table->dropColumn('altura_despegue_1','altura_despegue_2','altura_despegue_3','altura_despegue_4','altura_despegue_5');
        });
    }
}
