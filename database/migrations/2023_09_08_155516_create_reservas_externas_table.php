<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasExternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_externas', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido_id')->nullable();
            $table->string('orden_wordpress')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('email_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->boolean('privado')->default(false);
            $table->integer('numpax')->nullable();

            $table->date('fecha_reserva')->nullable();
            $table->string('zona')->nullable();
            $table->string('url_cupon')->nullable();
            $table->text('notas')->nullable();
            
            $table->string('estatus')->nullable();

            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas_externas');
    }
}
