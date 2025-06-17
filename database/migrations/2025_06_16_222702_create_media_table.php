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
        Schema::create('media', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the media
            $table->text('description')->nullable(); // Description of the media (nullable)
            $table->string('file_url'); // File URL of the media (e.g., video, audio)
            $table->enum('type', ['television', 'short_video', 'radio', 'podcast', 'audiobook']); // Media type
            $table->string('cover_image_url')->nullable(); // Cover image URL (nullable)
            $table->timestamp('publication_date')->nullable(); // Publication date (nullable)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key to Category
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to User
            $table->json('tags')->nullable(); // Tags as JSON (nullable)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
