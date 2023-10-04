<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsContactsToPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {            
            $table->string('nombre_contacto')->nullable();
             $table->string('ciudad_contacto')->nullable();
            $table->string('email_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('estatus')->default('creado')->nullable();
            $table->string('token')->nullable();
         });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('nombre_contacto','ciudad_contacto','email_contacto','telefono_contacto','estatus','token');
         });
    }
}
