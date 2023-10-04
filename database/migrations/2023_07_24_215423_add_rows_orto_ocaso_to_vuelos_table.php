<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsOrtoOcasoToVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->string('amanecer')->comment('dawn')->nullable();
            $table->string('anochecer')->comment('dusk')->nullable();
            $table->string('mediodia')->comment('noon')->nullable();
            $table->string('orto')->comment('sunrise')->nullable();
            $table->string('ocaso')->comment('sunset')->nullable();
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
            $table->dropColumn('amanecer','anochecer','mediodia','orto','ocaso');
        });
    }
}
