<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsExtrasToZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->integer('altura_despegue')->nullable();
            $table->string('meteoblue_url')->nullable();
            $table->string('meteoblue_donwload')->nullable();
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
            $table->dropColumn('altura_despegue','meteoblue_url','meteoblue_donwload');
        });
    }
}
