<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('color')->nullable();
            $table->string('url_despegue_1')->nullable();
            $table->string('url_despegue_2')->nullable();
            $table->string('foto')->nullable();
            $table->string('aerop_cercano')->nullable();
            $table->string('frecuencia')->nullable();
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
        Schema::dropIfExists('zones');
    }
}
