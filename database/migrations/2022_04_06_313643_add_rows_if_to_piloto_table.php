<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsIfToPilotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            $table->string('vuelo_if_doc_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            $table->dropColumn('vuelo_if_doc_path');
        });
    }
}
