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
        Schema::create('user_fcm_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fcm_token', 500); // VARCHAR instead of TEXT for unique constraint
            $table->string('device_type', 50)->nullable(); // browser name: Chrome, Firefox, etc.
            $table->timestamps();

            // Prevent duplicate tokens for same user
            $table->unique(['user_id', 'fcm_token'], 'user_fcm_token_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_fcm_tokens');
    }
};
