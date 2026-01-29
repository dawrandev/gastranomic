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
        Schema::table('favorites', function (Blueprint $table) {
            // Drop old foreign key constraint on client_id
            $table->dropForeign('favorites_client_id_foreign');

            // Make client_id NOT nullable (favorites now require authentication)
            $table->unsignedBigInteger('client_id')->nullable(false)->change();

            // Add new foreign key on client_id with cascade delete
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            // Add unique constraint on client_id + restaurant_id to prevent duplicate favorites
            $table->unique(['client_id', 'restaurant_id'], 'unique_client_favorite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            // Reverse the changes
            $table->dropUnique('unique_client_favorite');
            $table->dropForeign('favorites_client_id_foreign');

            $table->unsignedBigInteger('client_id')->nullable()->change();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }
};
