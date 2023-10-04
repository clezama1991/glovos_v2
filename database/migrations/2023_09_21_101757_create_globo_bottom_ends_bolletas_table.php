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
        Schema::create('globo_bottom_ends_bolletas', function (Blueprint $table) {
            $table->id();
            $table->integer('bottom_end_id');
            $table->integer('botella_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('globo_bottom_ends_bolletas');
    }
};
