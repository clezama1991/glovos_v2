<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('globos', function (Blueprint $table) {
            $table->integer('x_cuadriculas');
            $table->integer('y_cuadriculas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('globos', function (Blueprint $table) {
            $table->dropColumn('x_cuadriculas','y_cuadriculas');
        });
    }
};
