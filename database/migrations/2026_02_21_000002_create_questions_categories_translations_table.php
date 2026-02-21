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
        Schema::create('questions_categories_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questions_category_id')
                ->constrained('questions_categories')
                ->cascadeOnDelete();
            $table->string('lang_code', 10);
            $table->string('title')->comment('Question title (e.g., "What did you like?" or "Sizge ne jaqpadı?")');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['questions_category_id', 'lang_code'], 'uq_qc_trans_category_lang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_categories_translations');
    }
};
