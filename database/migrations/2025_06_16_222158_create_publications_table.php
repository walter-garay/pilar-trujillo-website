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
        Schema::create('publications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the publication
            $table->text('content')->nullable(); // Content of the publication
            $table->enum('status', ['active', 'archived']); // Status of the publication
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Author of the publication
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Category of the publication
            $table->json('tags')->nullable(); // Tags related to the publication
            $table->json('references')->nullable(); // References related to the publication
            $table->timestamps(); // Auto-generated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
