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
        Schema::create('actor_tv_series', function (Blueprint $table) {
            $table->id();

            $table->string('role');
            $table->foreignId('actor_id')->constrained();
            $table->foreignId('tv_series_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_tv_series');
    }
};
