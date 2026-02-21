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
        Schema::create('questions_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questions_category_id')
                ->constrained('questions_categories')
                ->cascadeOnDelete();
            $table->string('key')->comment('Option key for identification');
            $table->integer('sort_order')->default(0)->comment('Display order within category');
            $table->boolean('is_active')->default(true)->comment('Is this option active');
            $table->timestamps();

            $table->unique(['questions_category_id', 'key'], 'uq_qo_category_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_options');
    }
};
