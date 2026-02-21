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
        Schema::create('questions_options_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questions_option_id')
                ->constrained('questions_options')
                ->cascadeOnDelete();
            $table->string('lang_code', 10);
            $table->string('text', 500)->comment('Option text in specific language');
            $table->timestamps();

            $table->unique(['questions_option_id', 'lang_code'], 'uq_qo_trans_option_lang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_options_translations');
    }
};
