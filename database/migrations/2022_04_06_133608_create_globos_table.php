<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('logo')->nullable();
            $table->string('fabricante')->nullable();
            $table->string('modelo')->nullable();
            $table->string('mtom')->nullable();
            $table->string('min_mtom')->nullable();
            $table->date('arc')->nullable();
            $table->string('arc_doc')->nullable();
            $table->string('cert_matricula')->nullable();
            $table->string('seguro')->nullable();
            $table->string('peso_cesta')->nullable();
            $table->string('peso_globo')->nullable();
            $table->string('peso_botellas')->nullable();

            $table->text('notas')->nullable();

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
        Schema::dropIfExists('globos');
    }
}
