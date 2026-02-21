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
        Schema::create('questions_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Question category key (e.g., "quality", "service")');
            $table->integer('sort_order')->default(0)->comment('Display order');
            $table->boolean('is_required')->default(false)->comment('Is this question mandatory');
            $table->boolean('is_active')->default(true)->comment('Is this question active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_categories');
    }
};
