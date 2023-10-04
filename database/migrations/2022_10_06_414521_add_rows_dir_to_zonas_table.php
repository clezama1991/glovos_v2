<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsDirToZonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {            
            $table->string('despegue_whatsapp')->nullable();
            $table->string('logo')->nullable();
            $table->string('mensaje_personalizado')->nullable();
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
            $table->dropColumn('despegue_whatsapp','logo','mensaje_personalizado');
         });
    }
}
