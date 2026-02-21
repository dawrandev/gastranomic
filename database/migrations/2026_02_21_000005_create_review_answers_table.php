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
        Schema::create('review_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')
                ->constrained('reviews')
                ->cascadeOnDelete();
            $table->foreignId('questions_option_id')
                ->constrained('questions_options')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['review_id', 'questions_option_id'], 'uq_ra_review_option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_answers');
    }
};
