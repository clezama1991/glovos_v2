<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsBottomEndToGloboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('globos', function (Blueprint $table) {            
            $table->BigInteger('bottom_end_id')->unsigned()->nullable();
            $table->foreign('bottom_end_id')->references('id')->on('globo_bottom_ends');
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
            $table->dropColumn('bottom_end_id');
        });
    }
}
