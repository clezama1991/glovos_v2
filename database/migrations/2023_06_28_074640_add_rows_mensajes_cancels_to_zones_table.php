<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsMensajesCancelsToZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->text('mensaje_cancelacion_1')->nullable();
            $table->text('mensaje_cancelacion_2')->nullable();
            $table->text('mensaje_cancelacion_3')->nullable();
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
            $table->dropColumn('mensaje_cancelacion_1','mensaje_cancelacion_2','mensaje_cancelacion_3');
        });
    }
}
