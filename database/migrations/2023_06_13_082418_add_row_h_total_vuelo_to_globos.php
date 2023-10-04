<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowHTotalVueloToGlobos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('globos', function (Blueprint $table) {            
            $table->string('hora_total_vuelo')->nullable();
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
            $table->dropColumn('hora_total_vuelo');
        });
    }
}
