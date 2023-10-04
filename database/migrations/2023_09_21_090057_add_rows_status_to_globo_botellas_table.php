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
        Schema::table('globo_botellas', function (Blueprint $table) {
            $table->string('estatus')->nullable();
            $table->string('row_variant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('globo_botellas', function (Blueprint $table) {
            $table->dropColumn('estatus','row_variant');
        });
    }
};
