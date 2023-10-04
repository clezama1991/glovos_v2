<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsMultimediaDownloadToVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {            
            $table->json('multimedia_download_pedidos')->nullable();
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
            $table->dropColumn('multimedia_download_pedidos');
         });
    }
}
