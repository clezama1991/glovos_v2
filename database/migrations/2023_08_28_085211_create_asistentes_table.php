<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombre_corto')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('pin')->default('0000');
            $table->boolean('activo')->default(true);
            $table->string('notas')->nullable();
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
        Schema::dropIfExists('asistentes');
    }
}
