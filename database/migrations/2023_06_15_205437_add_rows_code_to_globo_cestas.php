<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsCodeToGloboCestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('globo_cestas', function (Blueprint $table) {
            $table->string('codigo')->after('fabricante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('globo_cestas', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
}
