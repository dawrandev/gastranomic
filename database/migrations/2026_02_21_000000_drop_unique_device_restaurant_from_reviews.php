<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop the unique constraint to allow multiple reviews per device per restaurant
            if (DB::getSchemaBuilder()->hasTable('reviews')) {
                $indexes = DB::select("SHOW INDEXES FROM reviews WHERE Key_name = 'unique_device_restaurant'");
                if (!empty($indexes)) {
                    $table->dropUnique('unique_device_restaurant');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unique(['device_id', 'restaurant_id'], 'unique_device_restaurant');
        });
    }
};
