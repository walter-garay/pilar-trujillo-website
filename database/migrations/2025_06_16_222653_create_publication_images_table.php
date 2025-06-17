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
        Schema::create('publication_images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('publication_id')->constrained('publications')->onDelete('cascade'); // Foreign key to Publication
            $table->string('file_url'); // File URL of the image
            $table->string('caption')->nullable(); // Caption for the image (nullable)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_images');
    }
};
