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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Sponsor name
            $table->string('logo_url')->nullable(); // Sponsor logo URL (nullable)
            $table->text('description')->nullable(); // Description of the sponsor (nullable)
            $table->string('email')->nullable(); // Email address (nullable)
            $table->string('phone')->nullable(); // Phone number (nullable)
            $table->json('social_media_urls')->nullable(); // Social media URLs (nullable)
            $table->string('media_url')->nullable(); // Media URL (nullable)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
