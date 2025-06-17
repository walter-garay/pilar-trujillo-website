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
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('file_url'); // File URL of the image
            $table->string('caption')->nullable(); // Caption for the image (nullable)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to User (uploads the image)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
