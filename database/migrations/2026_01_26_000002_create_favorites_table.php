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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('device_id', 100)->comment('Unique device identifier');
            $table->string('ip_address', 45)->nullable()->comment('IP address (IPv4/IPv6)');
            $table->timestamps();

            $table->unique(['device_id', 'restaurant_id'], 'unique_device_favorite');
            $table->index('device_id');
            $table->index('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
