<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasajerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable(); 
            $table->string('dni')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->text('notas')->nullable();
            $table->string('peso')->nullable();
            $table->boolean('activo')->default(1)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasajeros');
    }
}
