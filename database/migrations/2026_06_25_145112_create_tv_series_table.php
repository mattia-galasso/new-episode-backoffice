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
        Schema::create('tv_series', function (Blueprint $table) {
            $status = ['ongoing', 'ended'];
            $age_rating = ['AL', 'VM6', 'VM14', 'VM18'];


            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->enum('status', $status)->default('ongoing');
            $table->enum('age_rating', $age_rating)->default('AL');
            $table->integer('season_count')->default(1);
            $table->string('poster');
            $table->string('banner');
            $table->string('trailer_youtube_id', 11);
            $table->foreignId('production_company_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series');
    }
};
