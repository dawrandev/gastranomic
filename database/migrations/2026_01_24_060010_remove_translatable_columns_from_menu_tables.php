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
        Schema::table('menu_sections', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_sections', function (Blueprint $table) {
            $table->string('name')->after('brand_id');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('name')->after('menu_section_id');
            $table->text('description')->nullable()->after('name');
        });
    }
};
