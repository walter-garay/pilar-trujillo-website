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
        Schema::create('programs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Program title
            $table->text('description')->nullable(); // Program description
            $table->string('schedule')->nullable(); // Program schedule (nullable)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to User
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
