<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilotos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable(); 
            $table->string('dni')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('peso')->nullable();
            $table->string('direccion')->nullable();
            
            $table->date('licencia')->nullable();
            $table->string('licencia_doc')->nullable();
            $table->string('licencia_doc_path')->nullable();
            $table->date('cert_medico')->nullable();
            $table->string('cert_medico_doc')->nullable();
            $table->string('cert_medico_doc_path')->nullable();
            $table->date('cert_incendio')->nullable();
            $table->string('cert_incendio_doc')->nullable();
            $table->string('cert_incendio_doc_path')->nullable();
            $table->date('cert_primeros_auxilios')->nullable();
            $table->string('cert_primeros_auxilios_doc')->nullable();
            $table->string('cert_primeros_auxilios_doc_path')->nullable();
 
            $table->text('nota')->nullable();
            
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
        Schema::dropIfExists('pilotos');
    }
}
