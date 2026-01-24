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
        Schema::create('menu_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_section_id')->constrained()->onDelete('cascade');
            $table->string('lang_code', 5);
            $table->string('name');
            $table->timestamps();

            $table->foreign('lang_code')->references('code')->on('languages')->onDelete('cascade');
            $table->unique(['menu_section_id', 'lang_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_section_translations');
    }
};
