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
        Schema::table('globo_bottom_ends', function (Blueprint $table) {
            $table->integer('peso_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('globo_bottom_ends', function (Blueprint $table) {
            $table->dropColumn('peso_total');
        });
    }
};
