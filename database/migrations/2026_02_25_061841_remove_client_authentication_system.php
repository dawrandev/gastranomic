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
        // Order is critical to avoid FK constraint errors

        // 1. Drop favorites table (has FK to clients)
        Schema::dropIfExists('favorites');

        // 2. Drop client_id from reviews
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });

        // 3. Drop verification_codes
        Schema::dropIfExists('verification_codes');

        // 4. Drop clients table
        Schema::dropIfExists('clients');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate tables (note: data relationships will not be restored)

        // 1. Recreate clients table
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // 2. Recreate verification_codes table
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('code');
            $table->timestamp('expires_at');
            $table->timestamps();
        });

        // 3. Add client_id back to reviews
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable()->after('id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });

        // 4. Recreate favorites table
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->unique(['client_id', 'restaurant_id']);
        });
    }
};
